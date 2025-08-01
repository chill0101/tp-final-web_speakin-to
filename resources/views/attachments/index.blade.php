@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Listado de Archivos Adjuntos</h1>
    <div class="mb-6 flex gap-4">
        <x-primary-button onclick="window.location='{{ route('attachments.create') }}'">Crear Archivo</x-primary-button>
        <x-secondary-button onclick="window.history.back()">Volver atrás</x-secondary-button>
    </div>
    <table class="w-full table-auto border  overflow-hidden">
        <thead class="bg-primary">
            <tr>
                <th class="px-4 py-2">Título</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Curso</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attachments as $attachment)   {{-- Attachment list --}}
                <tr class="border-t hover:bg-accent/10">
                    <td class="px-4 py-2">{{ $attachment->title }}</td>
                    <td class="px-4 py-2">{{ $attachment->type }}</td>
                    <td class="px-4 py-2">{{ $attachment->course->title ?? '' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <x-primary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('attachments.show', $attachment) }}'">
                            <i class="fas fa-eye"></i> Ver
                        </x-primary-button>
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('attachments.download', $attachment) }}'">Descargar</x-secondary-button>
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('attachments.edit', $attachment) }}'">Editar</x-secondary-button>
                        <form method="POST" action="{{ route('attachments.destroy', $attachment) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este archivo adjunto?');" style="display:inline;">
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
