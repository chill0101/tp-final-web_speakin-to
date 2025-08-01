@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-2 text-secondary">Listado de Cursos</h1>
    <div class="mb-4">
        <span class="text-gray-700">Gestiona todos los cursos disponibles, consulta docentes asignados, estado y cupos. Puedes crear, editar y ver detalles de cada curso.</span>
    </div>  {{-- Metrics --}}
    <div class="mb-4 flex gap-6">
        <div class="bg-primary/10 rounded px-4 py-2 text-sm font-semibold text-secondary">
            Total de cursos: <span class="font-bold">{{ $courses->count() }}</span> {{-- count of courses --}}
        </div>
    </div>
    <div class="mb-6 flex gap-4">
        <x-primary-button onclick="window.location='{{ route('courses.create') }}'">Crear Curso</x-primary-button> {{-- onclick calls create course route --}}
        <x-secondary-button onclick="window.history.back()">Volver atrás</x-secondary-button>
    </div>
    <table class="w-full table-auto border  overflow-hidden">
        <thead class="bg-primary">
            <tr>
                <th class="px-4 py-2 text-left text-white font-semibold">Nombre</th>
                <th class="px-4 py-2 text-left text-white font-semibold">Descripción</th>
                <th class="px-4 py-2 text-left text-white font-semibold">Docente</th>
                <th class="px-4 py-2 text-left text-white font-semibold">Estado</th>
                <th class="px-4 py-2 text-left text-white font-semibold">Cupo</th>
                <th class="px-4 py-2 text-left text-white font-semibold">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr class="border-t hover:bg-accent/10">
                    <td class="px-4 py-2 align-middle font-bold text-secondary">{{ $course->title }}</td>
                    <td class="px-4 py-2 align-middle text-gray-800">{{ $course->description }}</td>
                    <td class="px-4 py-2 align-middle">{{ $course->teacher->name ?? '-' }}</td>
                    <td class="px-4 py-2 align-middle">{{ ucfirst($course->status) }}</td>
                    <td class="px-4 py-2 align-middle">{{ $course->max_capacity }}</td>
                    <td class="px-4 py-2 flex gap-2 align-middle">
                        <x-primary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('courses.show', $course) }}'">
                            <i class="fas fa-eye"></i> Ver
                        </x-primary-button>
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('courses.edit', $course) }}'">
                            <i class="fas fa-edit"></i> Editar
                        </x-secondary-button>
                        <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este curso?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="px-2 py-1 text-xs">Eliminar</x-danger-button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
