@extends('layouts.app')

@section('content')




<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Editar Evaluación</h1>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('evaluations.update', $evaluation) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-secondary font-bold text-base">Alumno:</span>
                <span class="text-gray-700 font-semibold">{{ $evaluation->student->first_name ?? $evaluation->student->name }} {{ $evaluation->student->last_name ?? '' }}</span>
                <span class="text-xs text-gray-500">(ID: {{ $evaluation->student->id }})</span>
            </div>
            <hr class="mb-2">
        </div>
        <div class="mb-4">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-secondary font-bold text-base">Curso:</span>
                <span class="text-gray-700 font-semibold">{{ $evaluation->course->title ?? $evaluation->course->name ?? '' }}</span>
                <span class="text-xs text-gray-500">(ID: {{ $evaluation->course->id }})</span>
            </div>
            <hr class="mb-2">
        </div>
        <div class="mb-4">
            <label for="score" class="block font-semibold mb-2">Nota</label>
            <input type="number" name="score" id="score" class="w-full rounded border px-3 py-2" value="{{ old('score', $evaluation->score) }}" min="0" max="10" step="0.01">
        </div>
        <div class="mb-4">
            <label for="date" class="block font-semibold mb-2">Fecha</label>
            <input type="date" name="date" id="date" class="w-full rounded border px-3 py-2" value="{{ old('date', $evaluation->date ?? ($evaluation->created_at ? $evaluation->created_at->format('Y-m-d') : '')) }}">
        </div>
        <div class="mb-4">
            <label for="comments" class="block font-semibold mb-2">Comentarios</label>
            <textarea name="comments" id="comments" class="w-full rounded border px-3 py-2">{{ old('comments', $evaluation->comments) }}</textarea>
        </div>
        <x-primary-button type="submit">Guardar cambios</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('evaluations.index') }}'">Cancelar</x-secondary-button>
        <x-secondary-button class="mt-4" onclick="window.location='{{ route('evaluations.index') }}'">Volver al listado</x-secondary-button>
    </form>
</div>
@endsection