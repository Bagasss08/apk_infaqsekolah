@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')

<h2>Detail Data Siswa</h2>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>

        <th width="200">
            Nama
        </th>

        <td>

            {{ $student->nama }}

        </td>

    </tr>

    <tr>

        <th>

            Kelas

        </th>

        <td>

            {{ $student->class->name }}

        </td>

    </tr>

    <tr>

        <th>

            Tahun Ajaran

        </th>

        <td>

            {{ $student->class->academicYear->name }}

        </td>

    </tr>

    <tr>

        <th>

            Status

        </th>

        <td>

            {{ $student->status }}

        </td>

    </tr>

    <tr>

        <th>

            Keterangan

        </th>

        <td>

            {{ $student->keterangan ?? '-' }}

        </td>

    </tr>

    <tr>

        <th>

            Dibuat

        </th>

        <td>

            {{ $student->created_at->format('d M Y H:i') }}

        </td>

    </tr>

    <tr>

        <th>

            Terakhir Diubah

        </th>

        <td>

            {{ $student->updated_at->format('d M Y H:i') }}

        </td>

    </tr>

</table>

<br>

<a href="{{ route('students.edit', $student->id) }}">

    Edit Data

</a>

|

<a href="{{ route('students.index') }}">

    Kembali

</a>

<hr>

<h3>Riwayat Tagihan</h3>

@if($student->studentFeeStatuses->count())

<table border="1" cellpadding="10" cellspacing="0">

    <thead>

    <tr>

        <th>No</th>
        <th>Jenis Tagihan</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Nominal</th>
        <th>Status</th>

    </tr>

    </thead>

    <tbody>

    @foreach($student->studentFeeStatuses as $item)

        <tr>

            <td>

                {{ $loop->iteration }}

            </td>

            <td>

                {{ $item->feeCategory->nama }}

            </td>

            <td>

                {{ $item->bulan }}

            </td>

            <td>

                {{ $item->tahun }}

            </td>

            <td>

                Rp {{ number_format($item->nominal,0,',','.') }}

            </td>

            <td>

                {{ $item->status }}

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@else

<p>

Belum memiliki riwayat pembayaran.

</p>

@endif

@endsection