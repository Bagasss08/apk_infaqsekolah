@extends('layouts.app')

@section('title','Edit Tarif')

@section('content')

<h2>Edit Tarif Tagihan</h2>

@if ($errors->any())

<ul>

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

@endif

<form
action="{{ route('fee-rates.update',$feeRate->id) }}"
method="POST">

@csrf
@method('PUT')

<div>

<label>Tahun Ajaran</label>

<br>

<select name="academic_year_id">

@foreach($academicYears as $year)

<option
value="{{ $year->id }}"
{{ old('academic_year_id',$feeRate->academic_year_id)==$year->id ? 'selected':'' }}>

{{ $year->name }}

</option>

@endforeach

</select>

</div>

<br>

<div>

<label>Kategori</label>

<br>

<select name="fee_category_id">

@foreach($categories as $category)

<option
value="{{ $category->id }}"
{{ old('fee_category_id',$feeRate->fee_category_id)==$category->id ? 'selected':'' }}>

{{ $category->name }}

</option>

@endforeach

</select>

</div>

<br>

<div>

<label>Tingkat</label>

<br>

<select name="tingkat">

<option value="1" {{ old('tingkat',$feeRate->tingkat)==1 ? 'selected':'' }}>Kelas 1</option>

<option value="2" {{ old('tingkat',$feeRate->tingkat)==2 ? 'selected':'' }}>Kelas 2</option>

<option value="3" {{ old('tingkat',$feeRate->tingkat)==3 ? 'selected':'' }}>Kelas 3</option>

</select>

</div>

<br>

<div>

<label>Nominal</label>

<br>

<input
type="number"
name="nominal"
value="{{ old('nominal',$feeRate->nominal) }}"
required>

</div>

<br>

<button type="submit">

Update

</button>

<a href="{{ route('fee-rates.index') }}">

Batal

</a>

</form>

@endsection