
@extends('layouts.app')

@section('content') {{-- Professor view will be simple in this first version :D --}}
<div class="max-w-3xl mx-auto mt-10 bg-white shadow p-8">
    <h1 class="text-3xl font-bold mb-8 text-secondary">Panel de Docente</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('courses.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
            <x-lucide-book class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
            <span class="font-semibold text-center">Mis Cursos</span>
        </a>
        <a href="{{ route('enrollments.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
            <x-lucide-user-check class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
            <span class="font-semibold text-center">Mis Inscripciones</span>
        </a>
        <a href="{{ route('evaluations.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
            <x-lucide-clipboard-list class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
            <span class="font-semibold text-center">Mis Evaluaciones</span>
        </a>
        <a href="{{ route('attachments.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
            <x-lucide-paperclip class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
            <span class="font-semibold text-center">Materiales y Archivos</span>
        </a>
    </div>
</div>
@endsection