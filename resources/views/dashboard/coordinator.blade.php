
@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <h1 class="text-3xl font-bold mb-2 text-secondary">Panel de Coordinación</h1>
        <div class="mb-4">
            <span class="text-gray-700">
                Bienvenido/a al panel de coordinación. Utiliza los accesos rápidos para navegar por las distintas secciones.
            </span>
        </div>
        {{-- Metrics --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-user class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Student::count() }}</p>
                    <p class="text-primary/80">Alumnos</p>
                </div>
            </div>
            <div class="bg-white p-6 shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-book class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Course::count() }}</p>
                    <p class="text-primary/80">Cursos</p>
                </div>
            </div>
            <div class="bg-white p-6 shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-user-check class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Enrollment::count() }}</p>
                    <p class="text-primary/80">Inscripciones</p>
                </div>
            </div>
        </div>
        {{-- QUICK ACCESSES --}}
        <div class="bg-neutral overflow-hidden shadow-sm  p-6 mt-8">
            <h3 class="text-xl font-semibold text-secondary mb-4">Accesos Rápidos</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('students.create') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-user-plus class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Registrar Alumno</span>
                </a>
                <a href="{{ route('enrollments.create') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-edit class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Registrar Inscripción</span>
                </a>
                <a href="{{ route('students.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-user class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Ver Alumnos</span>
                </a>
                <a href="{{ route('enrollments.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-user-check class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Ver Inscripciones</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
