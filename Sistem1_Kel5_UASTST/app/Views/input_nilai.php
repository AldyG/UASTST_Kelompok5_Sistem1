<?php include('header.php'); ?>

<div class="container">
    <h1>Input Nilai untuk Mata Kuliah: <?= $mataKuliah['nama'] ?> (<?= $mataKuliah['kode'] ?>)</h1>
    <form action="<?= site_url('nilai/simpanNilai') ?>" method="post">
        <input type="hidden" name="kode_matkul" value="<?= $mataKuliah['kode'] ?>">

        <?php foreach ($mahasiswaMatkul as $mhs): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mahasiswa_id" id="mahasiswa_id" value="<?= $mhs['nim_mahasiswa'] ?>" required>
                <label class="form-check-label" for="mahasiswa<?= $mhs['nim_mahasiswa'] ?>">
                    <?= $mhs['nim_mahasiswa'] ?>
                </label>
            </div>
        <?php endforeach; ?>

        <div class="form-group">
            <label for="kategori_nilai">Kategori Nilai</label>
            <select class="form-control" name="kategori_nilai" id="kategori_nilai">
                <option value="tugas">Tugas</option>
                <option value="uts">UTS</option>
                <option value="uas">UAS</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nilai">Nilai</label>
            <input type="number" class="form-control" name="nilai" id="nilai" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </form>
</div>

<?php include('footer.php'); ?>