@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Agregar Archivo Adjunto</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('attachments.store') }}" enctype="multipart/form-data"> {{-- action goes to the store --}}
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Título</label>
            <input type="text" name="title" id="title" class="w-full rounded border px-3 py-2" value="{{ old('title') }}">
        </div>
        <div class="mb-4">
            <label for="course_id" class="block font-semibold mb-2">Curso</label>
            <select name="course_id" id="course_id" class="w-full rounded border px-3 py-2">
                <option value="">Selecciona un curso</option>
                @foreach($courses as $course) {{-- List of courses --}}
                    <option value="{{ $course->id }}" @if(old('course_id') == $course->id) selected @endif>{{ $course->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="type" class="block font-semibold mb-2">Tipo</label>
            <select name="type" id="type" class="w-full rounded border px-3 py-2">
                <option value="material">Material</option>
                <option value="evaluacion">Evaluación</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="file" class="block font-semibold mb-2">Archivo</label>
            <input type="file" name="file" id="file" class="w-full rounded border px-3 py-2">
        </div>
        <x-primary-button type="submit">Guardar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('attachments.index') }}'">Cancelar</x-secondary-button>
    </form>
</div>
@endsection
