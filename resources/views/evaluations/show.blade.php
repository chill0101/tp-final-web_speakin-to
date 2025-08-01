@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Detalle de Evaluación</h1>
    <div class="mb-6">
        <div class="mb-2"><span class="font-semibold">Curso:</span> {{ $evaluation->course->title ?? $evaluation->course->name ?? '-' }}</div>
        <div class="mb-2"><span class="font-semibold">Alumno:</span> {{ $evaluation->student->first_name ?? '' }} {{ $evaluation->student->last_name ?? '' }}</div>
        <div class="mb-2"><span class="font-semibold">Nota:</span> {{ $evaluation->score }}</div>
        <div class="mb-2"><span class="font-semibold">Fecha:</span> {{ $evaluation->date ?? $evaluation->created_at->format('Y-m-d') }}</div>
        <div class="mb-2"><span class="font-semibold">Comentarios:</span> {{ $evaluation->comments }}</div>
    </div>
    <x-secondary-button onclick="window.location='{{ route('evaluations.index') }}'">Volver al listado</x-secondary-button>
</div>
@endsection
