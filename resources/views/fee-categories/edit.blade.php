@extends('layouts.app')

@section('title','Edit Kategori')

@section('content')

<h2>Edit Kategori Tagihan</h2>

@if ($errors->any())

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

@endif

<form
    action="{{ route('fee-categories.update',$category->id) }}"
    method="POST">

    @csrf
    @method('PUT')

    <div>

        <label>Nama Kategori</label>

        <br>

        <input
            type="text"
            name="name"
            value="{{ old('name',$category->name) }}"
            required>

    </div>

    <br>

    <div>

        <label>Deskripsi</label>

        <br>

        <textarea
            name="description"
            rows="4">{{ old('description',$category->description) }}</textarea>

    </div>

    <br>

    <button type="submit">

        Update

    </button>

    <a href="{{ route('fee-categories.index') }}">

        Batal

    </a>

</form>

@endsection