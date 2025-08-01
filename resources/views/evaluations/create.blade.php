@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Crear Evaluación</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('evaluations.store') }}">
        @csrf
        <div class="mb-4">
            <label for="student_id" class="block font-semibold mb-2">Alumno</label>
            <select name="student_id" id="student_id" class="w-full rounded border px-3 py-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="course_id" class="block font-semibold mb-2">Curso</label>
            <select name="course_id" id="course_id" class="w-full rounded border px-3 py-2">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title ?? $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="score" class="block font-semibold mb-2">Nota</label>
            <input type="number" name="score" id="score" min="1" max="10" class="w-full rounded border px-3 py-2" value="{{ old('score') }}">
        </div>
        <div class="mb-4">
            <label for="date" class="block font-semibold mb-2">Fecha</label>
            <input type="date" name="date" id="date" class="w-full rounded border px-3 py-2" value="{{ old('date', date('Y-m-d')) }}">
        </div>
        <div class="mb-4">
            <label for="comments" class="block font-semibold mb-2">Comentarios</label>
            <textarea name="comments" id="comments" class="w-full rounded border px-3 py-2">{{ old('comments') }}</textarea>
        </div>
        <x-primary-button type="submit">Guardar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('evaluations.index') }}'">Cancelar</x-secondary-button>
    </form>
</div>
@endsection
