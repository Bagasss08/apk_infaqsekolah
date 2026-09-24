@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')

<h2>Data Siswa</h2>

@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif

<br>

<a href="{{ route('students.create') }}">
    Tambah Siswa
</a>

&nbsp;

<a href="{{ route('students.index') }}">
    Refresh
</a>

<br><br>

<form method="GET" action="{{ route('students.index') }}">

    <input
        type="text"
        name="search"
        placeholder="Cari nama siswa..."
        value="{{ request('search') }}"
    >

    <select name="class_id">

        <option value="">Semua Kelas</option>

        @foreach($classes as $class)

            <option
                value="{{ $class->id }}"
                {{ request('class_id') == $class->id ? 'selected' : '' }}
            >
                {{ $class->name }}
            </option>

        @endforeach

    </select>

    <select name="status">

        <option value="">Semua Status</option>

        <option value="Aktif"
            {{ request('status')=='Aktif' ? 'selected':'' }}>
            Aktif
        </option>

        <option value="Lulus"
            {{ request('status')=='Lulus' ? 'selected':'' }}>
            Lulus
        </option>

        <option value="Pindah"
            {{ request('status')=='Pindah' ? 'selected':'' }}>
            Pindah
        </option>

    </select>

    <button type="submit">
        Cari
    </button>

</form>

<br>

<table border="1" cellpadding="10" cellspacing="0">

    <thead>

    <tr>

        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Tahun Ajaran</th>
        <th>Status</th>
        <th>Aksi</th>

    </tr>

    </thead>

    <tbody>

    @forelse($students as $student)

        <tr>

            <td>
                {{ $loop->iteration + ($students->currentPage()-1)*$students->perPage() }}
            </td>

            <td>{{ $student->nama }}</td>

            <td>{{ $student->class->name }}</td>

            <td>{{ $student->class->academicYear->name }}</td>

            <td>{{ $student->status }}</td>

            <td>

                <a href="{{ route('students.show',$student->id) }}">
                    Detail
                </a>

                |

                <a href="{{ route('students.edit',$student->id) }}">
                    Edit
                </a>

                |

                <form
                    action="{{ route('students.destroy',$student->id) }}"
                    method="POST"
                    style="display:inline;"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Yakin ingin menghapus?')"
                    >
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="7">

                Data siswa belum ada.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<br>

{{ $students->links() }}

@endsection