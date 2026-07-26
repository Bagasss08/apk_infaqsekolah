@extends('layouts.app')

@section('title','Tambah Siswa')

@section('content')

<h2>Tambah Data Siswa</h2>

@if($errors->any())

<div>

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('students.store') }}" method="POST">

    @csrf

    <table>

        <tr>

            <td>Nama Siswa</td>

            <td>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                >

            </td>

        </tr>

        <tr>

            <td>Kelas</td>

            <td>

                <select name="class_id">

                    <option value="">
                        Pilih Kelas
                    </option>

                    @foreach($classes as $class)

                        <option
                            value="{{ $class->id }}"
                            {{ old('class_id')==$class->id ? 'selected':'' }}
                        >

                            {{ $class->name }}
                            -
                            {{ $class->academicYear->name }}

                        </option>

                    @endforeach

                </select>

            </td>

        </tr>

        <tr>

            <td>Status</td>

            <td>

                <select name="status">

                    <option value="Aktif">Aktif</option>

                    <option value="Lulus">Lulus</option>

                    <option value="Pindah">Pindah</option>

                </select>

            </td>

        </tr>

        <tr>

            <td>Keterangan</td>

            <td>

                <textarea
                    name="keterangan"
                    rows="4"
                >{{ old('keterangan') }}</textarea>

            </td>

        </tr>

        <tr>

            <td></td>

            <td>

                <button type="submit">

                    Simpan

                </button>

                <a href="{{ route('students.index') }}">

                    Kembali

                </a>

            </td>

        </tr>

    </table>

</form>

@endsection