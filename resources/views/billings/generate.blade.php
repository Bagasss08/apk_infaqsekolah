@extends('layouts.app')

@section('title','Generate Tagihan')

@section('content')

<h2>Generate Tagihan Massal</h2>

<form action="#" method="POST">

@csrf

<label>Kelas</label>

<br>

<select name="class_id">

@foreach($classes as $class)

<option value="{{ $class->id }}">

{{ $class->name }}

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

<label>Bulan</label>

<br>

<input
type="number"
name="bulan"
min="1"
max="12">

<br><br>

<button type="submit">

Generate

</button>

</form>

@endsection