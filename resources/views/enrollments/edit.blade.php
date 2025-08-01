@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-neutral  shadow p-8">
    <h1 class="text-2xl font-bold mb-6 text-secondary">Editar Inscripción</h1>
    <form method="POST" action="{{ route('enrollments.update', $enrollment) }}">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="student_id" class="block font-semibold mb-2">Alumno</label>
            <select name="student_id" id="student_id" class="w-full rounded border px-3 py-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}" @if($enrollment->student_id == $student->id) selected @endif>{{ $student->first_name }} {{ $student->last_name }}</option> {{-- Student full name --}}
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="course_id" class="block font-semibold mb-2">Curso</label>
            <select name="course_id" id="course_id" class="w-full rounded border px-3 py-2">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" @if($enrollment->course_id == $course->id) selected @endif>{{ $course->name ?? $course->title }}</option> {{-- Course name --}}
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="enrollment_date" class="block font-semibold mb-2">Fecha de inscripción</label>
            <input type="date" name="enrollment_date" id="enrollment_date" class="w-full rounded border px-3 py-2" value="{{ old('enrollment_date', $enrollment->enrollment_date) }}">
            {{-- Default date is enrollment date --}}
        </div>
        <div class="mb-4">
            <label for="status" class="block font-semibold mb-2">Estado</label>
            <select name="status" id="status" class="w-full rounded border px-3 py-2">
                <option value="enrolled" @if($enrollment->status == 'enrolled') selected @endif>Inscripto</option>
                <option value="pending" @if($enrollment->status == 'pending') selected @endif>Pendiente</option>
                <option value="cancelled" @if($enrollment->status == 'cancelled') selected @endif>Cancelado</option>
            </select> {{-- Enrollment status --}}
        </div>
        <x-primary-button type="submit">Actualizar</x-primary-button>
        <x-secondary-button type="button" onclick="window.location='{{ route('enrollments.index') }}'">Cancelar</x-secondary-button>
        {{-- Back button --}}
        <x-secondary-button class="mt-4" onclick="window.location='{{ route('enrollments.index') }}'">Volver al listado</x-secondary-button>
    </form>
</div>
@endsection
