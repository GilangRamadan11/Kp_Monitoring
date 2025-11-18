<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gabungan - PT Indonesia Power</title>

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('css/data.css') ?>">

    <!-- Export Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <style>
        /* Styling khusus untuk aksi tabel */
        .action-cell {
            position: sticky;
            right: 0;
            background: white;
            z-index: 10;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            padding: 8px 5px;
            min-width: 90px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            transition: all 0.2s ease;
            margin: 0 2px;
        }

        .btn-edit {
            color: #fff;
            background-color: #0d6efd;
            border: 1px solid #0d6efd;
        }

        .btn-edit:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-1px);
        }

        .btn-delete {
            color: #fff;
            background-color: #dc3545;
            border: 1px solid #dc3545;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
            transform: translateY(-1px);
        }

        .tooltip-inner {
            font-size: 12px;
            padding: 4px 8px;
        }

        /* Modal konfirmasi hapus yang lebih profesional */
        .modal-danger .modal-header {
            background-color: #dc3545;
            color: white;
        }

        .modal-danger .modal-header .btn-close {
            color: white;
            filter: invert(1);
        }

        /* Styling untuk modal import */
        #importModal .modal-dialog {
            max-width: 500px;
        }

        #importProgress {
            height: 20px;
            margin: 15px 0;
        }

        #importStatus {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <?= $this->include('layouts/header'); ?>

    <div class="data-container">
        <div class="table-header">
            <h2 class="table-title">
                <i class="fas fa-table me-2"></i>Data Input Rembesan Bendungan
            </h2>

            <div class="btn-group mb-3" role="group">
                <a href="<?= base_url('input-data') ?>" class="btn btn-outline-primary">
                    <i class="fas fa-table"></i> Tabel Gabungan
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

        <!-- Modal Import SQL -->
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

        <div class="table-responsive">
            <table class="data-table" id="exportTable">
                <?php
                $srList = [1, 40, 66, 68, 70, 79, 81, 83, 85, 92, 94, 96, 98, 100, 102, 104, 106];
                $srColspan = count($srList) * 2;
                $twHeaders = ['A1 {R}', 'A1 {L}', 'B1', 'B3', 'B5'];

                $indexBy = fn(array $rows) => array_reduce($rows, fn($carry, $item) => isset($item['pengukuran_id']) ? $carry + [$item['pengukuran_id'] => $item] : $carry, []);
                $thomsonBy = $thomson ? $indexBy($thomson) : [];
                $srBy = $sr ? $indexBy($sr) : [];
                $bocoranBy = $bocoran ? $indexBy($bocoran) : [];
                $perhitunganThomsonBy = $perhitungan_thomson ? $indexBy($perhitungan_thomson) : [];
                $perhitunganSrBy = $perhitungan_sr ? $indexBy($perhitungan_sr) : [];
                $perhitunganBocoranBy = $perhitungan_bocoran ? $indexBy($perhitungan_bocoran) : [];
                $perhitunganIgBy = $perhitungan_ig ? $indexBy($perhitungan_ig) : [];
                $perhitunganSpillwayBy = $perhitungan_spillway ? $indexBy($perhitungan_spillway) : [];
                $tebingKananBy = $tebing_kanan ? $indexBy($tebing_kanan) : [];
                $totalBocoranBy = $total_bocoran ? $indexBy($total_bocoran) : [];
                $perhitunganBatasBy = $perhitungan_batas ? $indexBy($perhitungan_batas) : [];

                $fmt = fn($v, $dec = 2) => isset($v) && $v !== '' && $v !== null && $v != 0 ? number_format((float)$v, $dec, '.', '') : '-';
                $getSrQ = function ($row, $num) {
                    if (!$row) return null;
                    foreach (["q_sr_$num", "sr_{$num}_q", "sr{$num}_q", "q{$num}", "sr_$num"] as $k) {
                        if (isset($row[$k])) return $row[$k];
                    }
                    return null;
                };

                // ✅ Sort pengukuran by tahun ASC, bulan ASC
                if (!empty($pengukuran)) {
                    usort($pengukuran, function ($a, $b) {
                        $bulanMap = [
                            'Januari' => 1,
                            'Februari' => 2,
                            'Maret' => 3,
                            'April' => 4,
                            'Mei' => 5,
                            'Juni' => 6,
                            'Juli' => 7,
                            'Agustus' => 8,
                            'September' => 9,
                            'Oktober' => 10,
                            'November' => 11,
                            'Desember' => 12
                        ];
                        $tahunA = (int)($a['tahun'] ?? 0);
                        $tahunB = (int)($b['tahun'] ?? 0);
                        if ($tahunA === $tahunB) {
                            $bulanA = $bulanMap[$a['bulan']] ?? 13;
                            $bulanB = $bulanMap[$b['bulan']] ?? 13;
                            return $bulanA <=> $bulanB;
                        }
                        return $tahunA <=> $tahunB;
                    });
                }
                ?>

                <thead>
                    <tr>
                        <th rowspan="3" class="sticky">Tahun</th>
                        <th rowspan="3" class="sticky-2">Bulan</th>
                        <th rowspan="3" class="sticky-3">Periode</th>
                        <th rowspan="3" class="sticky-4">Tanggal</th>
                        <th rowspan="3" class="sticky-5">TMA Waduk</th>
                        <th rowspan="3" class="sticky-6">Curah Hujan</th>
                        <th rowspan="2" colspan="<?= count($twHeaders) ?>">Thomson Weir</th>
                        <th colspan="<?= $srColspan ?>">SR</th>
                        <th colspan="6" rowspan="2">Bocoran Baru</th>
                        <th colspan="5">Perhitungan Q Thompson Weir (Liter/Menit)</th>
                        <th rowspan="2" colspan="<?= count($srList) ?>">Perhitungan Q SR (Liter/Menit)</th>
                        <th rowspan="2" colspan="3">Perhitungan Bocoran Baru</th>
                        <th rowspan="2" colspan="2">Perhitungan Inti Galery</th>
                        <th rowspan="2" colspan="2">Perhitungan Bawah Bendungan/Spillway</th>
                        <th rowspan="2" colspan="2">Perhitungan Tebing Kanan</th>
                        <th rowspan="2" colspan="1">Perhitungan Tebing Kanan</th>
                        <th rowspan="2" colspan="1">Total Bocoran</th>
                        <th rowspan="2" colspan="1">Batasan Maksimal (Tahun)</th>
                        <th rowspan="3" class="action-cell">Aksi</th> <!-- Kolom Aksi Baru -->
                    </tr>
                    <tr>
                        <?php foreach ($srList as $num): ?>
                            <th colspan="2">SR <?= $num ?></th>
                        <?php endforeach; ?>
                        <th colspan="5">Thomson Weir (mm)</th>
                    </tr>
                    <tr>
                        <?php foreach ($twHeaders as $tw): ?>
                            <th><?= $tw ?></th>
                        <?php endforeach; ?>
                        <?php foreach ($srList as $num): ?>
                            <th>Nilai</th>
                            <th>Kode</th>
                        <?php endforeach; ?>
                        <th colspan="2">ELV 624 T1</th>
                        <th colspan="2">ELV 615 T2</th>
                        <th colspan="2">Pipa P1</th>
                        <th>R</th>
                        <th>L</th>
                        <th>B-1</th>
                        <th>B-3</th>
                        <th>B-5</th>
                        <?php foreach ($srList as $num): ?><th>SR <?= $num ?></th><?php endforeach; ?>
                        <th>Talang 1</th>
                        <th>Talang 2</th>
                        <th>Pipa</th>
                        <th>A1</th>
                        <th>Ambang</th>
                        <th>B3</th>
                        <th>Ambang</th>
                        <th>SR</th>
                        <th>Ambang</th>
                        <th>B5</th>
                        <th>R1</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    <?php if (!empty($pengukuran)):
                        $tahunCounts = [];
                        foreach ($pengukuran as $p) {
                            $tahun = $p['tahun'] ?? '-';
                            $tahunCounts[$tahun] = ($tahunCounts[$tahun] ?? 0) + 1;
                        }
                        $processedYears = [];
                        foreach ($pengukuran as $p):
                            $tahun   = $p['tahun'] ?? '-';
                            $bulan   = $p['bulan'] ?? '-';
                            $periode = $p['periode'] ?? '-';
                            $pid     = $p['id'] ?? null;

                            $thom   = $pid ? ($thomsonBy[$pid] ?? []) : [];
                            $srRow  = $pid ? ($srBy[$pid] ?? []) : [];
                            $boco   = $pid ? ($bocoranBy[$pid] ?? []) : [];
                            $pth    = $pid ? ($perhitunganThomsonBy[$pid] ?? []) : [];
                            $psr    = $pid ? ($perhitunganSrBy[$pid] ?? []) : [];
                            $pbb    = $pid ? ($perhitunganBocoranBy[$pid] ?? []) : [];
                            $pig    = $pid ? ($perhitunganIgBy[$pid] ?? []) : [];
                            $psp    = $pid ? ($perhitunganSpillwayBy[$pid] ?? []) : [];
                            $tk     = $pid ? ($tebingKananBy[$pid] ?? []) : [];
                            $tbTot  = $pid ? ($totalBocoranBy[$pid] ?? []) : [];
                            $pbatas = $pid ? ($perhitunganBatasBy[$pid] ?? []) : [];

                            $showTahun = !in_array($tahun, $processedYears);
                            if ($showTahun) $processedYears[] = $tahun;
                    ?>
                            <tr data-tahun="<?= esc($tahun) ?>" data-bulan="<?= esc($bulan) ?>" data-periode="<?= esc($periode) ?>" data-pid="<?= esc($pid) ?>">
                                <?php if ($showTahun): ?>
                                    <td rowspan="<?= $tahunCounts[$tahun] ?>" class="sticky"><?= esc($tahun) ?></td>
                                <?php endif; ?>
                                <td class="sticky-2"><?= esc($bulan) ?></td>
                                <td class="sticky-3"><?= esc($periode) ?></td>
                                <td class="sticky-4"><?= esc($p['tanggal'] ?? '-') ?></td>
                                <td class="sticky-5"><?= esc($p['tma_waduk'] ?? '-') ?></td>
                                <td class="sticky-6"><?= esc($p['curah_hujan'] ?? '-') ?></td>

                                <td><?= esc($thom['a1_r'] ?? '-') ?></td>
                                <td><?= esc($thom['a1_l'] ?? '-') ?></td>
                                <td><?= esc($thom['b1'] ?? '-') ?></td>
                                <td><?= esc($thom['b3'] ?? '-') ?></td>
                                <td><?= esc($thom['b5'] ?? '-') ?></td>

                                <?php foreach ($srList as $num): ?>
                                    <td><?= esc($srRow["sr_{$num}_nilai"] ?? '-') ?></td>
                                    <td><?= esc($srRow["sr_{$num}_kode"] ?? '-') ?></td>
                                <?php endforeach; ?>

                                <td><?= esc($boco['elv_624_t1'] ?? '-') ?></td>
                                <td><?= esc($boco['elv_624_t1_kode'] ?? '-') ?></td>
                                <td><?= esc($boco['elv_615_t2'] ?? '-') ?></td>
                                <td><?= esc($boco['elv_615_t2_kode'] ?? '-') ?></td>
                                <td><?= esc($boco['pipa_p1'] ?? '-') ?></td>
                                <td><?= esc($boco['pipa_p1_kode'] ?? '-') ?></td>

                                <td><?= esc($pth['a1_r'] ?? '-') ?></td>
                                <td><?= esc($pth['a1_l'] ?? '-') ?></td>
                                <td><?= esc($pth['b1'] ?? '-') ?></td>
                                <td><?= esc($pth['b3'] ?? '-') ?></td>
                                <td><?= esc($pth['b5'] ?? '-') ?></td>

                                <?php foreach ($srList as $num): ?>
                                    <?php $q = $getSrQ($psr, $num); ?>
                                    <td><?= $q === null ? '-' : $fmt($q, 6) ?></td>
                                <?php endforeach; ?>

                                <td><?= $fmt($pbb['talang1'] ?? null, 2) ?></td>
                                <td><?= $fmt($pbb['talang2'] ?? null, 2) ?></td>
                                <td><?= $fmt($pbb['pipa'] ?? null, 2) ?></td>

                                <td><?= $fmt($pig['a1'] ?? null, 2) ?></td>
                                <td><?= $fmt($pig['ambang_a1'] ?? null, 2) ?></td>

                                <td><?= $fmt($psp['B3'] ?? ($psp['b3'] ?? null), 2) ?></td>
                                <td><?= $fmt($psp['ambang'] ?? null, 2) ?></td>

                                <td><?= $fmt($tk['sr'] ?? null, 2) ?></td>
                                <td><?= $fmt($tk['ambang'] ?? null, 2) ?></td>
                                <td><?= esc($tk['B5'] ?? ($tk['b5'] ?? '-')) ?></td>

                                <td><?= $fmt($tbTot['R1'] ?? ($tbTot['r1'] ?? null), 2) ?></td>

                                <td><?= $fmt($pbatas['batas_maksimal'] ?? null, 2) ?></td>

                                <td class="action-cell">
                                    <div class="d-flex justify-content-center">
                                        <a href="<?= base_url('data/edit/' . $pid) ?>" class="btn-action btn-edit"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" class="btn-action btn-delete delete-btn"
                                            data-id="<?= $pid ?>" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?= $this->include('data/modal_hapus'); ?>
    <?= $this->include('layouts/footer'); ?>
