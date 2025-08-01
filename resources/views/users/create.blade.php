@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Agregar Usuario</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded" value="{{ old('name') }}">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" value="{{ old('email') }}">
        </div>
        <div class="mb-4">
            <label for="role" class="block font-semibold mb-2">Rol</label>
            <select name="role" id="role" class="w-full p-2 border rounded">
                <option value="coordinator">Coordinador</option>
                <option value="professor">Docente</option>
                <option value="admin">Administrador</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-2">Contraseña</label>
            <input type="password" name="password" id="password" class="w-full p-2 border rounded">
        </div>
        <x-primary-button class="px-4 py-2">Guardar</x-primary-button>
        <x-secondary-button class="ml-4 px-4 py-2" onclick="window.location='{{ route('users.index') }}'">Cancelar</x-secondary-button>
    </form>
</div>
@endsection
