<?php include('header.php'); ?>

<style>
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    h1, h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .table-responsive {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    ul {
        list-style: none;
        padding-left: 0;
    }

    li {
        background-color: #e9ecef;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        margin-bottom: 10px;
        padding: 10px;
        text-align: left;
    }

    .nim-nama-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nim, .nilai {
        font-weight: bold;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>


<div class="container">
    <h1>Nilai Mata Kuliah: <?= $kodeMatkul ?></h1>
    <table class="table">
        <thead>
            <tr>
                <th>NIM Mahasiswa</th>
                <th>Jenis</th>
                <th>Nilai</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nilaiMahasiswa as $nilai): ?>
                <tr>
                    <td><?= $nilai['nim_mahasiswa']; ?></td>
                    <td><?= $nilai['jenis']; ?></td>
                    <td><?= $nilai['nilai']; ?></td>
                    <td><?= $nilai['deskripsi']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Nilai Akhir Mahasiswa</h2>
    <ul>
    <?php foreach ($nilaiAkhirMahasiswa as $nim => $nilaiAkhir): ?>
        <li>
            <div class="nim-nama-container">
                <span class="nim">NIM: <?= $nim ?></span>
                <span class="nilai">Nilai: <?= $nilaiAkhir ?></span>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
<form action="<?= site_url('nilai/finalisasiNilai/' . $kodeMatkul) ?>" method="post">
    <button type="submit" class="btn btn-primary">Finalisasi Nilai</button>
</form>
</div>

<?php include('footer.php'); ?>