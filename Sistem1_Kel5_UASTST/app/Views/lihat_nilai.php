<?php include('header.php'); ?>

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
        <li><?= "NIM $nim: $nilaiAkhir" ?></li>
    <?php endforeach; ?>
</ul>
</div>

<?php include('footer.php'); ?>