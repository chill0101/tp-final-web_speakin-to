@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Detalle de Usuario</h1>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Rol:</strong> {{ $user->role }}</p>
    <x-primary-button class="mt-4" onclick="window.location='{{ route('users.index') }}'">Volver al listado</x-primary-button>
</div>
@endsection

{{-- Users single view --}}