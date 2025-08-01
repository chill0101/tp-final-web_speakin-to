@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral dark:bg-darkBackground rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-2 text-secondary dark:text-darkText">Listado de Alumnos</h1>
    <div class="mb-4">
        <span class="text-gray-700 dark:text-darkText">Este panel te permite gestionar todos los alumnos registrados en el sistema. Aquí puedes ver, editar y crear nuevos alumnos, así como acceder a sus datos y estado.</span>
    </div>
    <div class="mb-4 flex gap-6">
        <div class="bg-primary/10 rounded px-4 py-2 text-sm font-semibold text-secondary dark:text-darkText">
            Total de alumnos: <span class="font-bold">{{ $students->count() }}</span>
        </div>
    </div>
    <div class="mb-6 flex gap-4">
        <x-primary-button onclick="window.location='{{ route('students.create') }}'">Crear Alumno</x-primary-button>
        <x-secondary-button onclick="window.history.back()">Volver atrás</x-secondary-button>
    </div>
    <table class="w-full table-auto border rounded-lg overflow-hidden">
        <thead class="bg-primary dark:bg-secondary dark:text-darkText">
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">DNI</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr class="border-t dark:text-darkText hover:bg-accent/10">
                    <td class="px-4 py-2">{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td class="px-4 py-2">{{ $student->email }}</td>
                    <td class="px-4 py-2">{{ $student->dni }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <x-primary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('students.show', $student) }}'">
                            <i class="fas fa-eye"></i> Ver
                        </x-primary-button>
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('students.edit', $student) }}'">Editar</x-secondary-button>
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'coordinator')
                            <form method="POST" action="{{ route('students.destroy', $student) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este alumno?');" style="display:inline;">
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
