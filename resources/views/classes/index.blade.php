@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')

    <div class="mb-3">
        <a href="{{ route('classes.create') }}" class="btn btn-primary">
            Tambah Kelas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">

        <thead>
            <tr>
                <th width="60">No</th>
                <th>Tahun Ajaran</th>
                <th>Tingkat</th>
                <th>Nama Kelas</th>
                <th>Wali Kelas</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($classes as $class)

                <tr>

                    <td>
                        {{ $classes->firstItem() + $loop->index }}
                    </td>

                    <td>
                        {{ $class->academicYear->name ?? '-' }}
                    </td>

                    <td>
                        {{ $class->tingkat }}
                    </td>

                    <td>
                        {{ $class->name }}
                    </td>

                    <td>
                        {{ $class->wali_kelas ?? '-' }}
                    </td>

                    <td>

                        <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="text-center">
                        Belum ada data kelas.
                    </td>
                </tr>

            @endforelse
        </tbody>

    </table>

    {{ $classes->links() }}

@endsection