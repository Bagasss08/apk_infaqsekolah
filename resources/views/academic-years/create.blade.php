@extends('layouts.app')

@section('title', 'Tambah Tahun Ajaran')

@section('content')

<h2>Tambah Tahun Ajaran</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('academic-years.store') }}" method="POST">

    @csrf

    <div>
        <label>Tahun Ajaran</label><br>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Contoh : 2025/2026"
            required>
    </div>

    <br>

    <div>
        <label>Status</label><br>

        <select name="is_active">

            <option value="1"
                {{ old('is_active') == '1' ? 'selected' : '' }}>
                Aktif
            </option>

            <option value="0"
                {{ old('is_active') == '0' ? 'selected' : '' }}>
                Tidak Aktif
            </option>

        </select>
    </div>

    <br>

    <button type="submit">
        Simpan
    </button>

    <a href="{{ route('academic-years.index') }}">
        Kembali
    </a>

</form>

@endsection