@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Selamat datang di Sistem Administrasi Infaq Sekolah</p>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-secondary">Total Siswa</h6>
                    <h2 class="fw-bold">{{ $totalSiswa }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-secondary">Sudah Lunas</h6>
                    <h2 class="fw-bold text-success">{{ $sudahLunas }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-secondary">Belum Lunas</h6>
                    <h2 class="fw-bold text-danger">{{ $belumLunas }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-secondary">Tahun Ajaran Aktif</h6>
                    <h2 class="fw-bold">{{ $activeYear->name ?? '-' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">Total Infaq</div>
                <div class="card-body">
                    <h3 class="fw-bold text-primary">Rp {{ number_format($totalInfaq, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">Total LKS</div>
                <div class="card-body">
                    <h3 class="fw-bold text-success">Rp {{ number_format($totalLKS, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header">Total Sarpas</div>
                <div class="card-body">
                    <h3 class="fw-bold text-danger">Rp {{ number_format($totalSarpas, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header">Grafik Pembayaran Bulanan</div>
                <div class="card-body">
                    <canvas id="chartPembayaran" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header">Aktivitas Terbaru</div>
                <div class="card-body">
                    @forelse($aktivitasTerbaru as $item)
                        <div class="mb-2 pb-2 border-bottom">
                            <div class="small fw-semibold">Import: {{ $item->nama_file }}</div>
                            <div class="small text-muted">
                                {{ $item->berhasil }} berhasil, {{ $item->gagal }} gagal
                                &middot; {{ $item->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Belum ada aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
    new Chart(document.getElementById('chartPembayaran'), {
        type: 'bar',
        data: {
            labels: @json($bulanLabel),
            datasets: [{
                label: 'Total Pembayaran',
                data: @json($grafikData),
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush