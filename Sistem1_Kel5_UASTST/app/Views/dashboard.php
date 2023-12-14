<?php include('header.php'); ?>

<div class="container">
    <h1>Dashboard Dosen</h1>
    <p>Selamat datang, <?= $dosen['nama'] ?></p>

    <!-- Di dalam file view dashboard -->
    <?php foreach ($daftarMataKuliah as $mk): ?>
        <a href="<?= site_url('nilai/input/' . $mk['kode']) ?>">Input Nilai <?= $mk['nama'] ?> (<?= $mk['kode'] ?>)</a><br>
        <a href="<?= site_url('nilai/lihat/' . $mk['kode']) ?>">Lihat Nilai <?= $mk['nama'] ?> (<?= $mk['kode'] ?>)</a><br>
    <?php endforeach; ?>
</div>

<?php include('footer.php'); ?>
