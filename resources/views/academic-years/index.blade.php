@extends('layouts.app')

@section('title', 'Tahun Ajaran')

@section('content')

<h2>Data Tahun Ajaran</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<p>
    <a href="{{ route('academic-years.create') }}">
        + Tambah Tahun Ajaran
    </a>
</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="60">No</th>
            <th>Tahun Ajaran</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($academicYears as $year)

        <tr>
            <td>
                {{ $loop->iteration + ($academicYears->currentPage()-1) * $academicYears->perPage() }}
            </td>

            <td>
                {{ $year->name }}
            </td>

            <td>
                @if($year->is_active)
                    Aktif
                @else
                    Tidak Aktif
                @endif
            </td>

            <td>

                <a href="{{ route('academic-years.edit', $year->id) }}">
                    Edit
                </a>

                |

                <form action="{{ route('academic-years.destroy', $year->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        onclick="return confirm('Hapus data ini?')">
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="4" align="center">
                Belum ada data tahun ajaran.
            </td>
        </tr>

    @endforelse

    </tbody>
</table>

<br>

{{ $academicYears->links() }}

@endsection