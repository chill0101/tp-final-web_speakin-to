@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral dark:bg-darkBackground shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary dark:text-darkText">Editar Alumno</h1>
    <form method="POST" action="{{ route('students.update', $student) }}">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="first_name" class="block font-semibold mb-2">Nombre</label>
            <input type="text" name="first_name" id="first_name" class="w-full rounded border px-3 py-2" value="{{ old('first_name', $student->first_name) }}">
        </div>
        <div class="mb-4">
            <label for="last_name" class="block font-semibold mb-2">Apellido</label>
            <input type="text" name="last_name" id="last_name" class="w-full rounded border px-3 py-2" value="{{ old('last_name', $student->last_name) }}">
        </div>
        <div class="mb-4">
            <label for="dni" class="block font-semibold mb-2">DNI</label>
            <input type="text" name="dni" id="dni" class="w-full rounded border px-3 py-2" value="{{ old('dni', $student->dni) }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full rounded border px-3 py-2" value="{{ old('email', $student->email) }}">
        </div>
        <div class="mb-4">
            <label for="birth_date" class="block font-semibold mb-2">Fecha de nacimiento</label>
            <input type="date" name="birth_date" id="birth_date" class="w-full rounded border px-3 py-2" value="{{ old('birth_date', $student->birth_date) }}">
        </div>
        <div class="mb-4">
            <label for="phone" class="block font-semibold mb-2">Teléfono</label>
            <input type="text" name="phone" id="phone" class="w-full rounded border px-3 py-2" value="{{ old('phone', $student->phone) }}">
        </div>
        <div class="mb-4">
            <label for="address" class="block font-semibold mb-2">Dirección</label>
            <input type="text" name="address" id="address" class="w-full rounded border px-3 py-2" value="{{ old('address', $student->address) }}">
        </div>
        <div class="mb-4">
            <label for="gender" class="block font-semibold mb-2">Género</label>
            <select name="gender" id="gender" class="w-full rounded border px-3 py-2">
                <option value="male" @if($student->gender == 'male') selected @endif>Masculino</option>
                <option value="female" @if($student->gender == 'female') selected @endif>Femenino</option>
                <option value="other" @if($student->gender == 'other') selected @endif>Otro</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="active" class="block font-semibold mb-2">Activo</label>
            <select name="active" id="active" class="w-full rounded border px-3 py-2">
                <option value="1" @if($student->active) selected @endif>Sí</option>
                <option value="0" @if(!$student->active) selected @endif>No</option>
            </select>
        </div>
        <x-primary-button type="submit">Actualizar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('students.index') }}'">Cancelar</x-secondary-button>
        <x-secondary-button class="mt-4" onclick="window.location='{{ route('students.index') }}'">Volver al listado</x-secondary-button>
    </form>
</div>
@endsection
