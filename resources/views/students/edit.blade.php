@extends('layouts.app')

@section('title', 'Edit Data Siswa')

@section('content')

<h2>Edit Data Siswa</h2>

@if($errors->any())

<div>

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<form action="{{ route('students.update', $student->id) }}" method="POST">

    @csrf
    @method('PUT')

    <table cellpadding="5">

        <tr>

            <td>Nama Siswa</td>

            <td>

                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $student->nama) }}"
                >

            </td>

        </tr>

        <tr>

            <td>Kelas</td>

            <td>

                <select name="class_id">

                    @foreach($classes as $class)

                        <option
                            value="{{ $class->id }}"
                            {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}
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

                    <option
                        value="Aktif"
                        {{ old('status', $student->status)=='Aktif' ? 'selected':'' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="Lulus"
                        {{ old('status', $student->status)=='Lulus' ? 'selected':'' }}
                    >
                        Lulus
                    </option>

                    <option
                        value="Pindah"
                        {{ old('status', $student->status)=='Pindah' ? 'selected':'' }}
                    >
                        Pindah
                    </option>

                </select>

            </td>

        </tr>

        <tr>

            <td>Keterangan</td>

            <td>

                <textarea
                    name="keterangan"
                    rows="4"
                    cols="40"
                >{{ old('keterangan', $student->keterangan) }}</textarea>

            </td>

        </tr>

        <tr>

            <td></td>

            <td>

                <button type="submit">

                    Update

                </button>

                <a href="{{ route('students.index') }}">

                    Kembali

                </a>

            </td>

        </tr>

    </table>

</form>

@endsection