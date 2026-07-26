@extends('layouts.app')

@section('title', 'Edit Tahun Ajaran')

@section('content')

<h2>Edit Tahun Ajaran</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('academic-years.update', $academicYear->id) }}" method="POST">

    @csrf
    @method('PUT')

    <div>

        <label>Tahun Ajaran</label><br>

        <input
            type="text"
            name="name"
            value="{{ old('name', $academicYear->name) }}"
            required>

    </div>

    <br>

    <div>

        <label>Status</label><br>

        <select name="is_active">

            <option value="1"
                {{ old('is_active', $academicYear->is_active) == 1 ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="0"
                {{ old('is_active', $academicYear->is_active) == 0 ? 'selected' : '' }}>
                Tidak Aktif
            </option>

        </select>

    </div>

    <br>

    <button type="submit">
        Update
    </button>

    <a href="{{ route('academic-years.index') }}">
        Batal
    </a>

</form>

@endsection