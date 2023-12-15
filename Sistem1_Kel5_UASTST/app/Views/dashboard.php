<?php include('header.php'); ?>

<style>
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1 {
        color: #333;
        margin-bottom: 20px;
    }

    p {
        margin-bottom: 30px;
        color: #666;
    }

    a {
        display: inline-block;
        margin: 5px;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    a:hover {
        background-color: #0056b3;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #dc3545;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #c82333;
    }
</style>


<div class="container">
    <h1>Dashboard Dosen</h1>
    <p>Selamat datang, <?= $dosen['nama'] ?></p>

    <!-- Di dalam file view dashboard -->
    <?php foreach ($daftarMataKuliah as $mk): ?>
        <h2>Mata Kuliah  <?= $mk['nama'] ?> (<?= $mk['kode'] ?>)</h2>
        <a href="<?= site_url('nilai/input/' . $mk['kode']) ?>">Input Nilai</a><br>
        <a href="<?= site_url('nilai/lihat/' . $mk['kode']) ?>">Lihat Nilai</a><br>
    <?php endforeach; ?>
    <form action="<?= site_url('/logout') ?>" method="get">
        <button>Log out</button>
    </form>
</div>

<?php include('footer.php'); ?>
