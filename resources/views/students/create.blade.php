@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-neutral rounded-lg shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Agregar Alumno</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div class="mb-4">
            <label for="first_name" class="block font-semibold mb-2">Nombre</label>
            <input type="text" name="first_name" id="first_name" class="w-full rounded border px-3 py-2" value="{{ old('first_name') }}">
        </div>
        <div class="mb-4">
            <label for="last_name" class="block font-semibold mb-2">Apellido</label>
            <input type="text" name="last_name" id="last_name" class="w-full rounded border px-3 py-2" value="{{ old('last_name') }}">
        </div>
        <div class="mb-4">
            <label for="dni" class="block font-semibold mb-2">DNI</label>
            <input type="text" name="dni" id="dni" class="w-full rounded border px-3 py-2" value="{{ old('dni') }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full rounded border px-3 py-2" value="{{ old('email') }}">
        </div>
        <div class="mb-4">
            <label for="birth_date" class="block font-semibold mb-2">Fecha de nacimiento</label>
            <input type="date" name="birth_date" id="birth_date" class="w-full rounded border px-3 py-2" value="{{ old('birth_date') }}">
        </div>
        <div class="mb-4">
            <label for="phone" class="block font-semibold mb-2">Teléfono</label>
            <input type="text" name="phone" id="phone" class="w-full rounded border px-3 py-2" value="{{ old('phone') }}">
        </div>
        <div class="mb-4">
            <label for="address" class="block font-semibold mb-2">Dirección</label>
            <input type="text" name="address" id="address" class="w-full rounded border px-3 py-2" value="{{ old('address') }}">
        </div>
        <div class="mb-4">
            <label for="gender" class="block font-semibold mb-2">Género</label>
            <select name="gender" id="gender" class="w-full rounded border px-3 py-2">
                <option value="male" @if(old('gender')=='male') selected @endif>Masculino</option>
                <option value="female" @if(old('gender')=='female') selected @endif>Femenino</option>
                <option value="other" @if(old('gender')=='other') selected @endif>Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="active" class="block font-semibold mb-2">Activo</label>
            <input type="checkbox" name="active" id="active" value="1" @if(old('active', true)) checked @endif>
        </div>
        <x-primary-button type="submit">Guardar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('students.index') }}'">Cancelar</x-secondary-button>
    </form>
</div>
@endsection
