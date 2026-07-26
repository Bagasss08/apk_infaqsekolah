@extends('layouts.app')

@section('title','Tambah Kategori')

@section('content')

<h2>Tambah Kategori Tagihan</h2>

@if ($errors->any())

    <ul style="color:red">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

@endif

<form action="{{ route('fee-categories.store') }}" method="POST">

    @csrf

    <div>
        <label>Nama Kategori</label><br>

        <input
            type="text"
            name="nama"
            value="{{ old('nama') }}"
            required>
    </div>

    <br>

    <div>
        <label>Urutan</label><br>

        <input
            type="number"
            name="urutan"
            value="{{ old('urutan',1) }}">
    </div>

    <br>

    <div>

        <label>

            <input
                type="checkbox"
                name="aktif"
                value="1"
                checked>

            Aktif

        </label>

    </div>

    <br>

    <button type="submit">

        Simpan

    </button>

    <a href="{{ route('fee-categories.index') }}">

        Kembali

    </a>

</form>

@endsection