<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistem Infaq Sekolah')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    {{-- Custom CSS --}}
    <style>
        body{
            background:#f4f6f9;
            overflow-x:hidden;
        }

        .sidebar{
            width:250px;
            min-height:100vh;
            background:#0d6efd;
            position:fixed;
            left:0;
            top:0;
        }

        .sidebar h4{
            color:white;
            padding:20px;
            text-align:center;
            border-bottom:1px solid rgba(255,255,255,.2);
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 20px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,.15);
        }

        .content{
            margin-left:250px;
            padding:20px;
        }

        .navbar-custom{
            background:white;
            border-radius:10px;
            padding:15px 20px;
            margin-bottom:20px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .card{
            border:none;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }
    </style>

</head>

<body>

    {{-- Sidebar --}}
    <div class="sidebar">

        <h4>
            <i class="bi bi-wallet2"></i>
            Infaq Sekolah
        </h4>

        <a href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('students.index') }}">
            <i class="bi bi-people"></i>
            Data Siswa
        </a>

        <a href="{{ route('classes.index') }}">
            <i class="bi bi-building"></i>
            Data Kelas
        </a>

        <a href="{{ route('academic-years.index') }}">
            <i class="bi bi-calendar-event"></i>
            Tahun Ajaran
        </a>

        <a href="{{ route('fee-categories.index') }}">
            <i class="bi bi-tags"></i>
            Jenis Tagihan
        </a>

        <a href="{{ route('fee-rates.index') }}">
            <i class="bi bi-cash-stack"></i>
            Nominal Tagihan
        </a>

        <a href="{{ route('billings.index') }}">
            <i class="bi bi-receipt"></i>
            Tagihan
        </a>

        <a href="{{ route('imports.students') }}">
            <i class="bi bi-upload"></i>
            Import Siswa
        </a>

        <a href="{{ route('reports.index') }}">
            <i class="bi bi-file-earmark-bar-graph"></i>
            Laporan
        </a>

    </div>

    {{-- Content --}}
    <div class="content">

        {{-- Navbar --}}
        <div class="navbar-custom d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0">
                    @yield('title')
                </h4>

            </div>

            <div>

                <span class="fw-semibold">
                    Administrator
                </span>

            </div>

        </div>

        {{-- Content --}}
        @yield('content')

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>