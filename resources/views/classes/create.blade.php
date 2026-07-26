@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')

    <form action="{{ route('classes.store') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label class="form-label">

                Tahun Ajaran

            </label>

            <select name="academic_year_id" class="form-control">

                <option value="">

                    -- Pilih Tahun --

                </option>

                @foreach($academicYears as $year)

                    <option value="{{ $year->id }}">
                        {{ $year->name }}
                    </option>

                @endforeach

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

            <input type="text" name="name" class="form-control">

        </div>

        <div class="mb-3">

            <label class="form-label">

                Wali Kelas

            </label>

            <input type="text" name="wali_kelas" class="form-control">

        </div>

        <button class="btn btn-primary">

            Simpan

        </button>

        <a href="{{ route('classes.index') }}" class="btn btn-secondary">

            Kembali

        </a>

    </form>

@endsection