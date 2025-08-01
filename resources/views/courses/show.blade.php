@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Detalle del Curso</h1>
    <div class="mb-6">
        <div class="mb-2"><span class="font-semibold">Título:</span> {{ $course->title }}</div>
        <div class="mb-2"><span class="font-semibold">Descripción:</span> {{ $course->description }}</div>
        <div class="mb-2"><span class="font-semibold">Docente:</span> {{ $course->teacher->name ?? '-' }}</div>
        <div class="mb-2"><span class="font-semibold">Fecha de inicio:</span> {{ $course->start_date }}</div>
        <div class="mb-2"><span class="font-semibold">Fecha de fin:</span> {{ $course->end_date }}</div>
        <div class="mb-2"><span class="font-semibold">Estado:</span> {{ ucfirst($course->status) }}</div>
        <div class="mb-2"><span class="font-semibold">Modalidad:</span> {{ ucfirst($course->modality) }}</div>
        @if($course->virtual_link)
            <div class="mb-2"><span class="font-semibold">Enlace virtual:</span> <a href="{{ $course->virtual_link }}" class="text-blue-600 underline">{{ $course->virtual_link }}</a></div>
        @endif
        <div class="mb-2"><span class="font-semibold">Cupo máximo:</span> {{ $course->max_capacity }}</div>
    </div>
    <x-secondary-button onclick="window.location='{{ route('courses.index') }}'">Volver al listado</x-secondary-button>
    <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este curso?');" style="display:inline;">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4">Eliminar</x-danger-button>
    </form>
</div>
@endsection
