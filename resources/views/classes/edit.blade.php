@extends('layouts.app')

@section('title', 'Edit Kelas')

@section('content')

<h3>Edit Data Kelas</h3>

<hr>

<form action="#" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">
            Tahun Ajaran
        </label>

        <select name="academic_year_id" class="form-control">

            <option value="">
                -- Pilih Tahun Ajaran --
            </option>

            <option>
                2025 / 2026
            </option>

            <option>
                2026 / 2027
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Tingkat
        </label>

        <select name="tingkat" class="form-control">

            <option value="1">Kelas 1</option>
            <option value="2">Kelas 2</option>
            <option value="3">Kelas 3</option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">
            Nama Kelas
        </label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="">

    </div>

    <div class="mb-3">

        <label class="form-label">
            Wali Kelas
        </label>

        <input
            type="text"
            name="wali_kelas"
            class="form-control"
            value="">

    </div>

    <button
        type="submit"
        class="btn btn-primary">

        Update

    </button>

    <a
        href="{{ route('classes.index') }}"
        class="btn btn-secondary">

        Kembali

    </a>

</form>

@endsection