<?= $this->include('layouts/header'); ?>

<style>
    .menu-card {
        transition: all 0.3s ease;
        text-align: center;
        border-radius: 16px;
        cursor: pointer;
        background-color: #fff;
        border: 1px solid transparent;
    }

    /* Efek hover (interaktif) */
    .menu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(13, 110, 253, 0.3);
    }

    /* Saat diklik / aktif */
    .menu-card:active {
        transform: scale(0.98);
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.25);
        border-color: #0d6efd;
    }

    /* ikon menu */
    .menu-icon {
        transition: all 0.3s ease;
        background-color: rgba(13, 110, 253, 0.05);
        padding: 1rem;
        border-radius: 50%;
    }

    .menu-card:hover .menu-icon {
        background-color: rgba(13, 110, 253, 0.15);
        transform: scale(1.1);
    }

    .menu-card:active .menu-icon {
        background-color: rgba(13, 110, 253, 0.3);
        transform: scale(0.95);
    }

    /* teks menu */
    .menu-title {
        font-weight: 600;
        color: #212529;
        transition: color 0.3s ease;
    }

    .menu-card:hover .menu-title {
        color: #0d6efd;
    }

    .menu-card:active .menu-title {
        color: #084298;
    }

    .menu-card p {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 0.5rem;
        transition: color 0.3s ease;
    }

    .menu-card:hover p {
        color: #495057;
    }

    /* ====== RESPONSIF ====== */
    @media (max-width: 992px) {
        .menu-card {
            margin-bottom: 1.2rem;
        }

        .menu-icon i {
            font-size: 2.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .menu-card {
            padding: 1rem;
        }

        .menu-title {
            font-size: 1rem;
        }

        .menu-icon i {
            font-size: 2rem !important;
        }
    }


    @media (hover: none) {
        .menu-card:active {
            transform: scale(0.97);
            box-shadow: 0 6px 15px rgba(13, 110, 253, 0.2);
        }
    }
</style>

<main class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">Selamat Datang</h1>
        <p class="lead text-muted">Silakan pilih menu untuk mengelola sistem monitoring PLTA Saguling</p>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Menu 1: Input Data Rembesan -->
        <div class="col-12 col-md-5 col-lg-4">
            <a href="<?= base_url('/input-data-CurahHujan') ?>" class="text-decoration-none">
                <div class="card menu-card shadow-sm h-100 border-0">
                    <div class="card-body d-flex flex-column align-items-center py-4">
                        <div class="menu-icon bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-cloud-drizzle display-4 text-primary"></i>
                        </div>
                        <h5 class="mt-3 menu-title">Data Perhitungan Curah Hujan</h5>
                        <p class="text-muted small mt-2 text-center">
                            Input dan analisis data curah hujan secara real-time.
                        </p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Menu 2: Lihat Grafik -->
        <div class="col-12 col-md-5 col-lg-4">
            <a href="<?= base_url('/grafik') ?>" class="text-decoration-none">
                <div class="card menu-card shadow-sm h-100 border-0">
                    <div class="card-body d-flex flex-column align-items-center py-4">
                        <div class="menu-icon bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="bi bi-graph-up-arrow display-4 text-success"></i>
                        </div>
                        <h5 class="mt-3 menu-title">Lihat Grafik Data</h5>
                        <p class="text-muted small mt-2 text-center">
                            Visualisasi data monitoring dalam bentuk grafik dinamis.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Optional: Info Tambahan -->
    <div class="text-center mt-5">
        <small class="text-muted">
            Sistem Monitoring PLTA Saguling | PT PLN Indonesia Power - Saguling POMU
        </small>
    </div>
</main>

<?= $this->include('layouts/footer'); ?>