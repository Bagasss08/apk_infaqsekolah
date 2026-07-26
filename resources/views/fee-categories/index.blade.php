@extends('layouts.app')

@section('title', 'Kategori Tagihan')

@section('content')

<h2>Data Kategori Tagihan</h2>

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif

<p>
    <a href="{{ route('fee-categories.create') }}">
        + Tambah Kategori
    </a>
</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="60">No</th>
            <th>Nama Kategori</th>
            <th>Urutan</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>

    <tbody>

    @forelse($categories as $category)

        <tr>

            <td>
                {{ $loop->iteration + ($categories->currentPage()-1) * $categories->perPage() }}
            </td>

            <td>
                {{ $category->nama }}
            </td>

            <td>
                {{ $category->urutan }}
            </td>

            <td>
                {{ $category->aktif ? 'Aktif' : 'Tidak Aktif' }}
            </td>

            <td>

                <a href="{{ route('fee-categories.edit', $category->id) }}">
                    Edit
                </a>

                |

                <form action="{{ route('fee-categories.destroy', $category->id) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Yakin ingin menghapus?')">
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="5" align="center">
                Belum ada data kategori.
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

<br>

{{ $categories->links() }}

@endsection