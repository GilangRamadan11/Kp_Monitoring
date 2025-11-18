<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sandaran Kanan - PT Indonesia Power</title>
</head>

<body>
    <?= $this->include('layouts/header'); ?>
    <div class="data-container">
        <div class="table-header">
            <h2 class="table-title">
                <i class="fas fa-table me-2"></i>Data Input Sandaran Kanan
            </h2>

            <div class="btn-group mb-3" role="group">
                <a href="<?= base_url('input-data') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-table"></i> Tabel Sandaran Kanan
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

        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">
                            <i class="fas fa-database me-2"></i>Import Database SQL
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Upload file SQL yang telah diexport dari aplikasi Android. File akan diproses dan data akan diimpor ke database.
                        </div>

                        <div class="mb-3">
                            <label for="sqlFile" class="form-label">Pilih File SQL</label>
                            <input class="form-control" type="file" id="sqlFile" accept=".sql">
                        </div>

                        <div class="progress mb-3" style="display: none;" id="importProgress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                        </div>

                        <div id="importStatus" class="alert" style="display: none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="btnImportSQL">
                            <i class="fas fa-upload me-1"></i> Import
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <h5><i class="fas fa-filter me-2"></i>Filter Data</h5>
            <div class="filter-group">
                <!-- Tahun -->
                <div class="filter-item">
                    <label for="tahunFilter" class="form-label">Tahun</label>
                    <select id="tahunFilter" class="form-select">
                        <option value="">Semua Tahun</option>
                        <?php
                        if (!empty($pengukuran)):
                            $uniqueYears = array_unique(array_map(fn($p) => $p['tahun'] ?? '-', $pengukuran));
                            sort($uniqueYears);
                            foreach ($uniqueYears as $year):
                                if ($year === '-') continue;
                        ?>
                                <option value="<?= esc($year) ?>"><?= esc($year) ?></option>
                        <?php endforeach;
                        endif; ?>
                    </select>
                </div>

                <!-- Bulan -->
                <div class="filter-item">
                    <label for="bulanFilter" class="form-label">Bulan</label>
                    <select id="bulanFilter" class="form-select">
                        <option value="">Semua Bulan</option>
                        <?php
                        $bulanArr = [
                            'JAN',
                            'FEB',
                            'MAR',
                            'APR',
                            'MEI',
                            'JUN',
                            'JUL',
                            'AGS',
                            'SEP',
                            'OKT',
                            'NOV',
                            'DES'
                        ];
                        foreach ($bulanArr as $month):
                        ?>
                            <option value="<?= $month ?>"><?= $month ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Periode -->
                <div class="filter-item">
                    <label for="periodeFilter" class="form-label">Periode</label>
                    <select id="periodeFilter" class="form-select">
                        <option value="">Semua Periode</option>
                        <?php
                        if (!empty($pengukuran)):
                            $uniquePeriods = array_unique(array_map(fn($p) => $p['periode'] ?? '-', $pengukuran));
                            sort($uniquePeriods);
                            foreach ($uniquePeriods as $period):
                                if ($period === '-') continue;
                        ?>
                                <option value="<?= esc($period) ?>"><?= esc($period) ?></option>
                        <?php endforeach;
                        endif; ?>
                    </select>
                </div>

                <!-- Reset -->
                <div class="filter-item" style="align-self: flex-end;">
                    <button id="resetFilter" class="btn btn-secondary">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </button>
                </div>
            </div>
        </div>


    </div>
</body>

</html>

