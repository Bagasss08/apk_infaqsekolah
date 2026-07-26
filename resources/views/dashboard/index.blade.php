@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            Dashboard
        </h2>

        <p class="text-muted">
            Selamat datang di Sistem Administrasi Infaq Sekolah
        </p>
    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-secondary">
                        Total Siswa
                    </h6>

                    <h2 class="fw-bold">
                        0
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-secondary">
                        Sudah Lunas
                    </h6>

                    <h2 class="fw-bold text-success">
                        0
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-secondary">
                        Belum Lunas
                    </h6>

                    <h2 class="fw-bold text-danger">
                        0
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-secondary">
                        Tahun Ajaran Aktif
                    </h6>

                    <h2 class="fw-bold">
                        -
                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-2">

        <div class="col-lg-4 mb-3">

            <div class="card shadow-sm">

                <div class="card-header">
                    Total Infaq
                </div>

                <div class="card-body">

                    <h3 class="fw-bold text-primary">

                        Rp 0

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-3">

            <div class="card shadow-sm">

                <div class="card-header">
                    Total LKS
                </div>

                <div class="card-body">

                    <h3 class="fw-bold text-success">

                        Rp 0

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-3">

            <div class="card shadow-sm">

                <div class="card-header">
                    Total Sarpas
                </div>

                <div class="card-body">

                    <h3 class="fw-bold text-danger">

                        Rp 0

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-3">

        <div class="col-lg-8">

            <div class="card shadow-sm">

                <div class="card-header">

                    Grafik Pembayaran Bulanan

                </div>

                <div class="card-body text-center">

                    Grafik akan tampil di sini.

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow-sm">

                <div class="card-header">

                    Aktivitas Terbaru

                </div>

                <div class="card-body">

                    Belum ada aktivitas.

                </div>

            </div>

        </div>

    </div>

</div>

@endsection