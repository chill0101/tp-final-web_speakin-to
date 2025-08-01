@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <h1 class="text-3xl font-bold mb-2 text-secondary">Panel de Administración</h1>
        <div class="mb-4">
            <span class="text-gray-700">
                Bienvenido/a al panel de administración. Utiliza los accesos rápidos para navegar por las distintas secciones.
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
            <div class="bg-white p-6  shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-graduation-cap class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\User::where('role', 'professor')->count() }}</p>
                    <p class="text-primary/80">Docentes</p>
                </div>
            </div>
            <div class="bg-white p-6  shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-book class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Course::count() }}</p>
                    <p class="text-primary/80">Cursos</p>
                </div>
            </div>
            <div class="bg-white p-6  shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-user-plus class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Enrollment::count() }}</p>
                    <p class="text-primary/80">Inscripciones</p>
                </div>
            </div>
            <div class="bg-white p-6  shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-clipboard-check class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Evaluation::count() }}</p>
                    <p class="text-primary/80">Evaluaciones</p>
                </div>
            </div>
            <div class="bg-white p-6  shadow border border-primary flex items-center">
                <div class="flex-shrink-0 bg-primary/10  p-3">
                    <x-lucide-paperclip class="w-10 h-10 text-primary" />
                </div>
                <div class="ml-4">
                    <p class="text-3xl font-bold text-primary">{{ \App\Models\Attachment::count() }}</p>
                    <p class="text-primary/80">Archivos Adjuntos</p>
                </div>
            </div>
        </div>
        {{-- QUICK ACCESSES --}}
        <div class="bg-neutral overflow-hidden shadow-sm  p-6 mt-8">
            <h3 class="text-xl font-semibold text-secondary mb-4">Accesos Rápidos</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('students.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-user class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Alumnos</span>
                </a>
                <a href="{{ route('users.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-graduation-cap class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Docentes</span>
                </a>
                <a href="{{ route('courses.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-book class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Cursos</span>
                </a>
                <a href="{{ route('enrollments.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-user-plus class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Inscripciones</span>
                </a>
                <a href="{{ route('evaluations.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-clipboard-check class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Evaluaciones</span>
                </a>
                <a href="{{ route('attachments.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-paperclip class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Archivos Adjuntos</span>
                </a>
                <a href="{{ route('users.index') }}" class="bg-primary/90 p-4 rounded-md shadow-lg flex flex-col items-center justify-center text-white group hover:bg-neutral hover:text-gray-600 transition h-32">
                    <x-lucide-users class="w-8 h-8 mb-2 text-white group-hover:text-secondary" />
                    <span class="font-semibold text-center">Usuarios</span>
                </a>
            </div>
        </div>
    </div>
</div>
        
@endsection