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
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-check-label {
        margin-left: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
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
            <input type="number" class="form-control" name="nilai" id="nilai" min=0 max=100 required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </form>
</div>

<?php include('footer.php'); ?>