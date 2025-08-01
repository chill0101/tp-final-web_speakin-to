@extends('layouts.app') 

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Listado de Usuarios</h1>
    <div class="mb-6 flex gap-4">
        <x-primary-button onclick="window.location='{{ route('users.create') }}'">Agregar Usuario</x-primary-button>
        <x-secondary-button onclick="window.history.back()">Volver atrás</x-secondary-button>
    </div>
    <table class="w-full table-auto border  overflow-hidden">
        <thead class="bg-primary">
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Rol</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-t hover:bg-accent/10">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->role }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <x-primary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('users.show', $user) }}'">Ver</x-primary-button>
                        
                        <x-secondary-button class="px-2 py-1 text-xs" onclick="window.location='{{ route('users.edit', $user) }}'">Editar</x-secondary-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
