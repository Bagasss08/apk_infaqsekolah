@extends('layouts.app')

@section('title', 'Tambah Tarif Tagihan')

@section('content')

    <h2>Tambah Tarif Tagihan</h2>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('fee-rates.store') }}" method="POST">

        @csrf

        <div>
            <label>Tahun Ajaran</label>
            <br>

            <select name="academic_year_id">

                @foreach($academicYears as $year)

                    <option value="{{ $year->id }}">
                        {{ $year->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <br>

        <div>

            <label>Kategori Tagihan</label>

            <br>

            <select name="fee_category_id" required>

                <option value="">-- Pilih Kategori --</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}" {{ old('fee_category_id') == $category->id ? 'selected' : '' }}>

                        {{ $category->nama }}

                    </option>

                @endforeach

            </select>

        </div>

        <br>

        <div>

            <label>Tingkat / Kelas</label>

            <br>

            <select name="tingkat" required>

                <option value="">-- Pilih Tingkat --</option>

                <option value="1" {{ old('tingkat') == 1 ? 'selected' : '' }}>
                    Kelas 1
                </option>

                <option value="2" {{ old('tingkat') == 2 ? 'selected' : '' }}>
                    Kelas 2
                </option>

                <option value="3" {{ old('tingkat') == 3 ? 'selected' : '' }}>
                    Kelas 3
                </option>

            </select>

        </div>

        <br>

        <div>

            <label>Nominal Tagihan</label>

            <br>

            <input
                type="text"
                name="nominal"
                id="nominal"
                value="{{ old('nominal') }}"
                inputmode="numeric"
                placeholder="Contoh : 500.000"
                required
            >

        </div>

        <br>

        <button type="submit">
            Simpan
        </button>

        <a href="{{ route('fee-rates.index') }}">
            Kembali
        </a>

    </form>

    <script>
    document.getElementById('nominal').addEventListener('input', function () {

        // Hanya mengambil angka
        let angka = this.value.replace(/\D/g, '');

        // Memberikan titik setiap 3 angka
        this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    });
</script>

@endsection