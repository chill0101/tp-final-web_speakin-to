@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Detalle de Inscripción</h1>
    <div class="mb-6">
        <div class="mb-2"><span class="font-semibold">Alumno:</span> {{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</div>
        <div class="mb-2"><span class="font-semibold">Curso:</span> {{ $enrollment->course->title ?? '' }}</div>
        <div class="mb-2"><span class="font-semibold">Fecha de inscripción:</span> {{ $enrollment->enrollment_date }}</div>
        <div class="mb-2"><span class="font-semibold">Estado:</span> {{ ucfirst($enrollment->status) }}</div>
        <div class="mb-2"><span class="font-semibold">Nota final:</span> {{ $enrollment->final_grade ?? '-' }}</div>
        <div class="mb-2"><span class="font-semibold">Asistencias:</span> {{ $enrollment->attendance ?? '-' }}</div>
        <div class="mb-2"><span class="font-semibold">Observaciones:</span> {{ $enrollment->notes ?? '-' }}</div>
        <div class="mb-2"><span class="font-semibold">Evaluado por docente:</span> {{ $enrollment->graded_by_teacher ? 'Sí' : 'No' }}</div>
    </div>
    <x-secondary-button onclick="window.location='{{ route('enrollments.index') }}'">Volver al listado</x-secondary-button>
</div>
@endsection
