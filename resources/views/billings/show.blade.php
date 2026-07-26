@extends('layouts.app')

@section('title','Detail Tagihan')

@section('content')

<h2>Detail Tagihan</h2>

<p>

<b>Nama :</b>

{{ $billing->student->nama }}

</p>

<p>

<b>Kategori :</b>

{{ $billing->feeCategory->nama }}

</p>

<p>

<b>Tahun Ajaran :</b>

{{ $billing->academicYear->name }}

</p>

<p>

<b>Bulan :</b>

{{ $billing->bulan }}

</p>

<p>

<b>Nominal :</b>

Rp {{ number_format($billing->nominal,0,',','.') }}

</p>

<p>

<b>Status :</b>

{{ $billing->status }}

</p>

<p>

<b>Catatan :</b>

{{ $billing->catatan }}

</p>

@endsection