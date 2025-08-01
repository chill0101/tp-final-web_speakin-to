@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Agregar Inscripción</h1>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded">
            <ul class="list-disc pl-5 text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> {{-- Error message --}}
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('enrollments.store') }}">
        @csrf
        <div class="mb-4">
            <label for="student_id" class="block font-semibold mb-2">Alumno</label>
            <select name="student_id" id="student_id" class="w-full rounded border px-3 py-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option> {{-- Student full name --}}
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="course_id" class="block font-semibold mb-2">Curso</label>
            <select name="course_id" id="course_id" class="w-full rounded border px-3 py-2">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name ?? $course->title }}</option> {{-- Course name --}}
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="enrollment_date" class="block font-semibold mb-2">Fecha de inscripción</label>
            <input type="date" name="enrollment_date" id="enrollment_date" class="w-full rounded border px-3 py-2" value="{{ old('enrollment_date', date('Y-m-d')) }}">
            {{-- Default date is today  --}}
        </div>
        <div class="mb-4">
            <label for="status" class="block font-semibold mb-2">Estado</label>
            <select name="status" id="status" class="w-full rounded border px-3 py-2">
                <option value="enrolled">Inscripto</option>
                <option value="pending">Pendiente</option>
                <option value="cancelled">Cancelado</option>
            </select> {{-- Enrollment status --}}
        </div>
        <x-primary-button type="submit">Guardar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('enrollments.index') }}'">Cancelar</x-secondary-button>
        {{-- Back button --}}
    </form>
</div>
@endsection
