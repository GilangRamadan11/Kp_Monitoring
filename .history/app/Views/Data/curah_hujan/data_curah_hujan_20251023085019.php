<!DOCTYPE html>
<html>
<head>
    <title>Input Data Hidrologi</title>
</head>
<body>
    <h1>Form Input Data Hidrologi</h1>

    <?php if(session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/input-data-hidrologi/save') ?>" method="post">
        <label>Curah Hujan (mm):</label><br>
        <input type="number" step="0.01" name="curah_hujan" required><br><br>

        <label>Debit Air (m³/s):</label><br>
        <input type="number" step="0.01" name="debit_air" required><br><br>

        <label>Tinggi Muka Air (m):</label><br>
        <input type="number" step="0.01" name="tinggi_muka_air" required><br><br>

        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>

        <button type="submit">Simpan Data</button>
    </form>
</body>
</html>
