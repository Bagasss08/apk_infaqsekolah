@extends('layouts.app')

@section('title', 'Tarif Tagihan')

@section('content')

<h2>Data Tarif Tagihan</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<p>
    <a href="{{ route('fee-rates.create') }}">
        + Tambah Tarif
    </a>
</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <th>Kategori</th>
            <th>Tingkat</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($feeRates as $rate)

        <tr>

            <td>
                {{ $loop->iteration + ($feeRates->currentPage()-1) * $feeRates->perPage() }}
            </td>

            <td>{{ $rate->academicYear->name }}</td>

            <td>{{ $rate->feeCategory->nama }}</td>

            <td>{{ $rate->tingkat }}</td>

            <td>
                Rp {{ number_format($rate->nominal,0,',','.') }}
            </td>

            <td>

                <a href="{{ route('fee-rates.edit',$rate->id) }}">
                    Edit
                </a>

                |

                <form
                    action="{{ route('fee-rates.destroy',$rate->id) }}"
                    method="POST"
                    style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Yakin ingin menghapus?')">

                        Hapus

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="6" align="center">

                Belum ada data tarif.

            </td>
        </tr>

    @endforelse

    </tbody>

</table>

<br>

{{ $feeRates->links() }}

@endsection