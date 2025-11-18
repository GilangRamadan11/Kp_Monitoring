<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sandaran Kiri - PT Indonesia Power</title>
</head>

<body>
    <?= $this->include('layouts/header'); ?>
    <div class="data-container">
        <div class="table-header">
            <h2 class="table-title">
                <i class="fas fa-table me-2"></i>Data Input Sandaran Kiri
            </h2>

            <div class="btn-group mb-3" role="group">
                <a href="<?= base_url('input-data') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-table"></i> Tabel Sandaran
                </a>
                <a href="<?= base_url('data/tabel_thomson') ?>" class="btn btn-outline-success">
                    <i class="fas fa-eye"></i> Lihat Tabel Thomson
                </a>
                <a href="<?= base_url('lihat/tabel_ambang') ?>" class="btn btn-outline-warning">
                    <i class="fas fa-ruler"></i> Rumus Ambang Batas
                </a>
                <a href="<?= base_url('analisaLookBurt') ?>" class="btn btn-outline-danger">
                    <i class="fas fa-chart-line"></i> Analisa Look Burt
                </a>

                <a href="<?= base_url('data/create') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-1"></i> Add Data
                </a>

                <!-- Tombol Import SQL -->
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-database"></i> Import SQL
                </button>
            </div>

            <div class="table-controls">
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Cari data..." id="searchInput">
                </div>
            </div>
        </div>


    </div>
</body>

</html>

