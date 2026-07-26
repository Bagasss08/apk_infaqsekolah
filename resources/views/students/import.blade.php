@extends('layouts.app')

@section('title', 'Import Data Siswa')

@section('content')

<h2>Import Data Siswa</h2>

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div>
        {{ session('error') }}
    </div>
@endif

@if($errors->any())

<div>

    <ul>

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<p>
Silakan upload file Excel (.xlsx atau .xls) sesuai template yang telah disediakan.
</p>

<br>

<a href="{{ route('students.template') }}">
    Download Template Excel
</a>

<br><br>

<form action="{{ route('imports.students') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <table>

        <tr>

            <td>File Excel</td>

            <td>

                <input
                    type="file"
                    name="file"
                    accept=".xlsx,.xls"
                    required
                >

            </td>

        </tr>

        <tr>

            <td></td>

            <td>

                <button type="submit">

                    Import Data

                </button>

                <a href="{{ route('students.index') }}">

                    Kembali

                </a>

            </td>

        </tr>

    </table>

</form>

@endsection