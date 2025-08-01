<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    // List all attachments
    public function index()
    {
        if (auth()->user()->role === 'professor') {
            $attachments = Attachment::with('course')
                ->whereHas('course', function ($q) {
                    $q->where('teacher_id', auth()->id());
                })->get();
        } else {
            $attachments = Attachment::with('course')->get();
        }
        return view('attachments.index', compact('attachments'));
    }

    // Show create form
    public function create()
    {
        $courses = Course::all();
        return view('attachments.create', compact('courses'));
    }

    // Store a new attachment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:task,material,guide',
            'file' => 'required|file|max:10240|mimes:pdf,docx,ppt,jpg,jpeg,png',
        ]);
        
        // Check permissions: only admin and professor can upload attachments
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'professor'])) {
            return back()->withErrors(['file' => __('Solo administradores o docentes pueden subir archivos.')]);
        }

        $file = $request->file('file');
        $filePath = $file->store('attachments');

        $attachment = Attachment::create([
            'course_id' => $validated['course_id'],
            'title' => $validated['title'],
            'file_url' => $filePath,
            'type' => $validated['type'],
            'uploaded_at' => now(),
        ]);

        return redirect()->route('attachments.index')->with('success', __('Archivo adjunto subido correctamente.'));
    }

    // Show an attachment
    public function show(Attachment $attachment)
    {
        // Returns the Blade view for attachment details
        return view('attachments.show', compact('attachment'));
    }

    // Download an attachment
    public function download(Attachment $attachment)
    {
        $originalExtension = pathinfo($attachment->file_url, PATHINFO_EXTENSION);
        $downloadName = $attachment->title . ($originalExtension ? '.' . $originalExtension : '');
        return Storage::download($attachment->file_url, $downloadName);
    }

    // Delete an attachment
    public function destroy(Attachment $attachment)
    {
        Storage::delete($attachment->file_url);
        $attachment->delete();
        return redirect()->route('attachments.index')->with('success', __('Archivo adjunto eliminado correctamente.'));
    }

    // Show edit form
    public function edit(Attachment $attachment)
    {
        return view('attachments.edit', compact('attachment'));
    }

    // Update an attachment
    public function update(Request $request, Attachment $attachment)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:material,evaluacion,otro',
            'file' => 'nullable|file|max:10240|mimes:pdf,docx,ppt,jpg,jpeg,png',
        ]);

        $attachment->title = $validated['title'];
        $attachment->type = $validated['type'];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($attachment->file_url) {
                Storage::delete($attachment->file_url);
            }
            $file = $request->file('file');
            $filePath = $file->store('attachments');
            $attachment->file_url = $filePath;
        }

        $attachment->save();

        return redirect()->route('attachments.index')->with('success', __('Archivo adjunto actualizado correctamente.'));
    }
}
