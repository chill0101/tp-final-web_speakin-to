@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Detalle de Alumno</h1>
    <div class="mb-6">
        <div class="mb-2"><span class="font-semibold">Nombre:</span> {{ $student->first_name }} {{ $student->last_name }}</div>
        <div class="mb-2"><span class="font-semibold">DNI:</span> {{ $student->dni }}</div>
        <div class="mb-2"><span class="font-semibold">Email:</span> {{ $student->email }}</div>
        <div class="mb-2"><span class="font-semibold">Fecha de nacimiento:</span> {{ $student->birth_date }}</div>
        <div class="mb-2"><span class="font-semibold">Teléfono:</span> {{ $student->phone }}</div>
        <div class="mb-2"><span class="font-semibold">Dirección:</span> {{ $student->address }}</div>
        <div class="mb-2"><span class="font-semibold">Género:</span> {{ ucfirst($student->gender) }}</div>
        <div class="mb-2"><span class="font-semibold">Activo:</span> {{ $student->active ? 'Sí' : 'No' }}</div>
    </div>
    <x-secondary-button onclick="window.location='{{ route('students.index') }}'">Volver al listado</x-secondary-button>
    <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?');" style="display:inline;">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4">Eliminar</x-danger-button>
    </form>
</div>
@endsection
