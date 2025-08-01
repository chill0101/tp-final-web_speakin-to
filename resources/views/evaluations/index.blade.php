@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-2 text-secondary">Listado de Evaluaciones</h1>
    <div class="mb-4">
        <span class="text-gray-700">Consulta y gestiona las evaluaciones realizadas a los alumnos en cada curso. Puedes agregar, editar y revisar comentarios y notas.</span>
    </div>
    <div class="mb-4 flex gap-6">
        <div class="bg-primary/10 rounded px-4 py-2 text-sm font-semibold text-secondary">
            Total de evaluaciones: <span class="font-bold">{{ $evaluations->count() }}</span>
        </div>
    </div>
    <div class="mb-6 flex gap-4">
        <x-primary-button onclick="window.location='{{ route('evaluations.create') }}'">Crear Evaluación</x-primary-button>
        <x-secondary-button onclick="window.history.back()">Volver atrás</x-secondary-button>
    </div>
    <table class="w-full table-auto border  overflow-hidden">
        <thead class="bg-primary">
            <tr>
                <th class="px-4 py-2">Curso</th>
                <th class="px-4 py-2">Alumno</th>
                <th class="px-4 py-2">Nota</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Comentarios</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluations as $evaluation)
                <tr class="border-t hover:bg-accent/10">
                    <td class="px-4 py-2">{{ $evaluation->course->title ?? $evaluation->course->name ?? '' }}</td>
                    <td class="px-4 py-2">{{ $evaluation->student->first_name ?? '' }} {{ $evaluation->student->last_name ?? '' }}</td>
                    <td class="px-4 py-2">{{ $evaluation->score }}</td>
                    <td class="px-4 py-2">{{ $evaluation->date ?? $evaluation->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $evaluation->comments }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <x-primary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('evaluations.show', $evaluation) }}'">Ver</x-primary-button>
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('evaluations.edit', $evaluation) }}'">Editar</x-secondary-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
