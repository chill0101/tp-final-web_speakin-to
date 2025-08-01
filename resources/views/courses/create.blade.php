
    @extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Crear Curso</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>  {{-- Error message --}}
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-2">Título</label>
            <input type="text" name="title" id="title" class="w-full rounded border px-3 py-2" value="{{ old('title') }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Descripción</label>
            <textarea name="description" id="description" class="w-full rounded border px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="start_date" class="block font-semibold mb-2">Fecha de inicio</label>
            <input type="date" name="start_date" id="start_date" class="w-full rounded border px-3 py-2" value="{{ old('start_date') }}" required>
        </div>
        <div class="mb-4">
            <label for="end_date" class="block font-semibold mb-2">Fecha de fin</label>
            <input type="date" name="end_date" id="end_date" class="w-full rounded border px-3 py-2" value="{{ old('end_date') }}" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block font-semibold mb-2">Estado</label>
            <select name="status" id="status" class="w-full rounded border px-3 py-2" required>
                <option value="active" @if(old('status')=='active') selected @endif>Activo</option>
                <option value="finished" @if(old('status')=='finished') selected @endif>Finalizado</option>
                <option value="cancelled" @if(old('status')=='cancelled') selected @endif>Cancelado</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="modality" class="block font-semibold mb-2">Modalidad</label>
            <select name="modality" id="modality" class="w-full rounded border px-3 py-2" required>
                <option value="on_site" @if(old('modality')=='on_site') selected @endif>Presencial</option>
                <option value="virtual" @if(old('modality')=='virtual') selected @endif>Virtual</option>
                <option value="hybrid" @if(old('modality')=='hybrid') selected @endif>Híbrida</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="virtual_link" class="block font-semibold mb-2">Enlace virtual</label>
            <input type="text" name="virtual_link" id="virtual_link" class="w-full rounded border px-3 py-2" value="{{ old('virtual_link') }}">
        </div>
        <div class="mb-4">
            <label for="max_capacity" class="block font-semibold mb-2">Cupo máximo</label>
            <input type="number" name="max_capacity" id="max_capacity" class="w-full rounded border px-3 py-2" min="1" value="{{ old('max_capacity') }}" required>
        </div>
        <div class="mb-4">
            <label for="teacher_id" class="block font-semibold mb-2">Docente</label>
            <select name="teacher_id" id="teacher_id" class="w-full rounded border px-3 py-2" required>
                <option value="">Selecciona un docente</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" @if(old('teacher_id') == $teacher->id) selected @endif>
                        {{ $teacher->name }} ({{ $teacher->email }})  {{-- Teacher name and email --}}
                    </option>
                @endforeach
            </select>
        </div>
        <x-primary-button type="submit">Crear</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('courses.index') }}'">Cancelar</x-secondary-button>
    </form>
</div>
@endsection
