@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Detalle de Archivo Adjunto</h1>
    <div class="mb-4">
        <strong>Título:</strong> {{ $attachment->title }}
    </div>
    <div class="mb-4">
        <strong>Tipo:</strong> {{ $attachment->type }}
    </div>
    <div class="mb-4">
        <strong>Archivo:</strong>
        @if($attachment->file_url)
            <a href="{{ route('attachments.download', $attachment) }}" class="underline text-primary">Descargar archivo</a>
        @else
            <span class="text-gray-500">No disponible</span>
        @endif
    </div>
    <div class="flex gap-4 mt-4">
        <x-primary-button onclick="window.location='{{ route('attachments.index') }}'">Volver al listado</x-primary-button>
        <form method="POST" action="{{ route('attachments.destroy', $attachment) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este archivo adjunto?');" style="display:inline;">
            @csrf
            @method('DELETE')  {{-- confirm delete --}}
            <x-danger-button>Eliminar</x-danger-button>
        </form>
    </div>
</div>
@endsection
