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

        h1 {
          text-align: center;
          color: #333;
          margin-bottom: 30px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            color: #212529;
            border-collapse: collapse;
        }

        table, th, td {
          padding: 0.75rem;
          vertical-align: top;
          border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-back {
          display: inline-block;
          padding: 10px 20px;
          margin-top: 20px;
          font-size: 16px;
          color: white;
          background-color: #333;
          text-decoration: none;
          border-radius: 5px;
        }

        .btn-back:hover {
          background-color: #555;
        }
    </style>

<div class="container">
    <h1>Data Mahasiswa</h1>
    <table>
        <tr>
            <th>NIM</th>
            <th>IP</th>
            <th>IPK</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs): ?>
        <tr>
            <td><?= esc($mhs['nim']); ?></td>
            <td><?= is_null($mhs['ip']) ? 'Belum Ada' : esc($mhs['ip']); ?></td>
            <td><?= esc($mhs['ipk']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="/dashboard" class="btn btn-back">Kembali ke Dashboard</a>
</div>

<?php include('footer.php'); ?>