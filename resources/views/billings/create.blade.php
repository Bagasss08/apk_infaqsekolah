@extends('layouts.app')

@section('title','Tambah Tagihan')

@section('content')

<h2>Tambah Tagihan</h2>

<form action="{{ route('billings.store') }}" method="POST">

@csrf

<label>Siswa</label>

<br>

<select name="student_id">

@foreach($students as $student)

<option value="{{ $student->id }}">

{{ $student->nama }}

</option>

@endforeach

</select>

<br><br>

<label>Kategori</label>

<br>

<select name="fee_category_id">

@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->nama }}

</option>

@endforeach

</select>

<br><br>

<label>Tahun Ajaran</label>

<br>

<select name="academic_year_id">

@foreach($academicYears as $year)

<option value="{{ $year->id }}">

{{ $year->name }}

</option>

@endforeach

</select>

<br><br>

<label>Bulan</label>

<br>

<input type="number" name="bulan">

<br><br>

<label>Tahun</label>

<br>

<input type="number" name="tahun">

<br><br>

<label>Nominal</label>

<br>

<input type="number" name="nominal">

<br><br>

<button type="submit">

Simpan

</button>

</form>

@endsection