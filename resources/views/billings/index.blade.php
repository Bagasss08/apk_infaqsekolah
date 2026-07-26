@extends('layouts.app')

@section('title','Tagihan Siswa')

@section('content')

<h2>Data Tagihan Siswa</h2>

<p>
    <a href="{{ route('billings.generate') }}">
        Generate Tagihan
    </a>
</p>

<table border="1" cellpadding="8" width="100%">

<thead>

<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Kategori</th>
    <th>Tahun Ajaran</th>
    <th>Bulan</th>
    <th>Nominal</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

</thead>

<tbody>

@forelse($billings as $billing)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $billing->student->nama }}</td>

<td>{{ $billing->feeCategory->nama }}</td>

<td>{{ $billing->academicYear->name }}</td>

<td>{{ $billing->bulan }}</td>

<td>
Rp {{ number_format($billing->nominal,0,',','.') }}
</td>

<td>{{ $billing->status }}</td>

<td>

<a href="{{ route('billings.show',$billing->id) }}">
Detail
</a>

</td>

</tr>

@empty

<tr>

<td colspan="8">

Belum ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

@endsection