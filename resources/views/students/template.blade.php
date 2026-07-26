@extends('layouts.app')

@section('title','Template Import Siswa')

@section('content')

<h2>Template Import Data Siswa</h2>

<p>

Format Excel harus mengikuti contoh berikut.

</p>

<table border="1" cellpadding="10">

    <thead>

    <tr>

        <th>No</th>

        <th>Nama</th>

        <th>Kelas</th>

        <th>Status</th>

        <th>Keterangan</th>

    </tr>

    </thead>

    <tbody>

    <tr>

        <td>1</td>

        <td>Bagas Widyastama</td>

        <td>1A</td>

        <td>Aktif</td>

        <td>-</td>

    </tr>

    <tr>

        <td>2</td>

        <td>Andi Saputra</td>

        <td>1B</td>

        <td>Aktif</td>

        <td>Pindahan</td>

    </tr>

    </tbody>

</table>

<br>

<h3>Keterangan</h3>

<ul>

    <li>Nama kelas harus sama dengan data master kelas.</li>

    <li>Status hanya boleh:
        <strong>Aktif</strong>,
        <strong>Lulus</strong>,
        <strong>Pindah</strong>
    </li>

    <li>Kolom keterangan boleh dikosongkan.</li>

</ul>

<br>

<a href="{{ route('students.index') }}">

    Kembali

</a>

@endsection