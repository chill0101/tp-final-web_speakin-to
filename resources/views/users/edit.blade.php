@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Editar Usuario</h1>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full p-2 border rounded">
        </div>
        <div class="mb-4">
            <label for="role" class="block font-semibold mb-2">Rol</label>
            <input type="text" name="role" id="role" value="{{ $user->role }}" class="w-full p-2 border rounded">
        </div>
        <x-primary-button class="px-4 py-2">Guardar</x-primary-button>
        <x-secondary-button class="ml-4 px-4 py-2" onclick="window.location='{{ route('users.index') }}'">Cancelar</x-secondary-button>
    </form>
</div>
@endsection
