@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-2 text-secondary">Listado de Inscripciones</h1>
    <div class="mb-4">
        <span class="text-gray-700">Aquí puedes ver y gestionar todas las inscripciones de alumnos a cursos, su estado y fechas. Puedes crear nuevas inscripciones y editar las existentes.</span>
    </div>
    <div class="mb-4 flex gap-6">
        <div class="bg-primary/10 rounded px-4 py-2 text-sm font-semibold text-secondary">
            Total de inscripciones: <span class="font-bold">{{ $enrollments->count() }}</span>
        </div>
    </div>
    <div class="mb-6 flex gap-4">
        <x-primary-button onclick="window.location='{{ route('enrollments.create') }}'">Crear Inscripción</x-primary-button>
        <x-secondary-button onclick="window.history.back()">Volver atrás</x-secondary-button>
    </div>
    <table class="w-full table-auto border  overflow-hidden">
        <thead class="bg-primary">
            <tr>
                <th class="px-4 py-2">Alumno</th>
                <th class="px-4 py-2">Curso</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
                <tr class="border-t hover:bg-accent/10">
                    <td class="px-4 py-2">{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
                    <td class="px-4 py-2">{{ $enrollment->course->title ?? '' }}</td>
                    <td class="px-4 py-2">{{ $enrollment->enrollment_date }}</td>
                    <td class="px-4 py-2">{{ $enrollment->status }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <x-primary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('enrollments.show', $enrollment) }}'">
                            <i class="fas fa-eye"></i> Ver
                        </x-primary-button>
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('enrollments.edit', $enrollment) }}'">
                            <i class="fas fa-edit"></i> Editar
                        </x-secondary-button>
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'coordinator')
                            <form method="POST" action="{{ route('enrollments.destroy', $enrollment) }}" onsubmit="return confirm('¿Seguro que deseas eliminar esta inscripción?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="px-2 py-1 text-xs">Eliminar</x-danger-button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection