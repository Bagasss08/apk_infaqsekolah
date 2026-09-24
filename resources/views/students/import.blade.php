@extends('layouts.app')

@section('title', 'Import Siswa')

@section('content')

<h2>Import Data Siswa</h2>

@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('imports.students.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <table>

        <tr>
            <td>File Siswa</td>

            <td>
                <input
                    type="file"
                    name="file"
                    accept=".xlsx,.xls,.csv"
                    required
                >
            </td>
        </tr>

        <tr>
            <td></td>

            <td>
                <button type="submit">
                    Import Siswa
                </button>

                <a href="{{ route('students.index') }}">
                    Kembali
                </a>
            </td>
        </tr>

    </table>

</form>

@endsection