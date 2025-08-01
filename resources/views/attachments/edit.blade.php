@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Editar Archivo Adjunto</h1>
    <form method="POST" action="{{ route('attachments.update', $attachment) }}" enctype="multipart/form-data"> {{-- Store --}}
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Título</label>
            <input type="text" name="title" id="title" class="w-full rounded border px-3 py-2" value="{{ old('title', $attachment->title) }}">
        </div>
        <div class="mb-4">
            <label for="type" class="block font-semibold mb-2">Tipo</label>
            <select name="type" id="type" class="w-full rounded border px-3 py-2">
                <option value="material" @if($attachment->type == 'material') selected @endif>Material</option>
                <option value="evaluacion" @if($attachment->type == 'evaluacion') selected @endif>Evaluación</option>
                <option value="otro" @if($attachment->type == 'otro') selected @endif>Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="file" class="block font-semibold mb-2">Archivo (opcional)</label>
            <input type="file" name="file" id="file" class="w-full rounded border px-3 py-2">
            @if($attachment->file_url)  {{-- If there's a file then we show the attachment url button --}}
                <p class="mt-2 text-sm">Archivo actual: <a href="{{ Storage::url($attachment->file_url) }}" target="_blank" class="underline text-primary">Ver archivo</a></p>
            @endif
        </div>
        <x-primary-button type="submit">Actualizar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('attachments.index') }}'">Cancelar</x-secondary-button>  {{-- back --}}
        <x-secondary-button class="mt-4" onclick="window.location='{{ route('attachments.index') }}'">Volver al listado</x-secondary-button>
    </form>
</div>
@endsection
