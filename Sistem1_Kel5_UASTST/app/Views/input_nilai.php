<?php include('header.php'); ?>

<div class="container">
    <h1>Input Nilai Mahasiswa</h1>
    <form action="/nilai/simpan" method="post">
        <div class="form-group">
            <label for="mahasiswa_id">ID Mahasiswa</label>
            <input type="text" class="form-control" name="mahasiswa_id" id="mahasiswa_id" required>
        </div>
        <div class="form-group">
            <label for="mata_kuliah_id">ID Mata Kuliah</label>
            <input type="text" class="form-control" name="mata_kuliah_id" id="mata_kuliah_id" required>
        </div>
        <div class="form-group">
            <label for="nilai">Nilai</label>
            <input type="number" class="form-control" name="nilai" id="nilai" required>
        </div>
        <div class="form-group">
            <label for="kategori_nilai">Kategori Nilai</label>
            <select class="form-control" name="kategori_nilai" id="kategori_nilai">
                <option value="tugas">Tugas</option>
                <option value="uts">UTS</option>
                <option value="uas">UAS</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </form>
</div>

<?php include('footer.php'); ?>

