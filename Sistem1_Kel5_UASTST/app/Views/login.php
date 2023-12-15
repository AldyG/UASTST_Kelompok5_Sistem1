<?php include('header.php'); ?>

<style>
    .container {
        max-width: 400px;
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
        margin-bottom: 30px;
    }

    form div {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 4px;
        background-color: #5cb85c;
        color: white;
        cursor: pointer;
        font-size: 16px;
    }

    button[type="submit"]:hover {
        background-color: #4cae4c;
    }

    .error-message {
        color: #ff0000; /* Merah */
        background-color: #ffecec; /* Latar belakang merah muda */
        border: 1px solid #ff0000; /* Border merah */
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
    }


</style>


<div class="container">
    <h1>Login Dosen</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="error-message">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <form action="<?= site_url('/login') ?>" method="post">
    <div>
        <label for="nidn">NIDN:</label>
        <input type="text" name="nidn" id="nidn" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Login</button>
</form>
</div>

<?php include('footer.php'); ?>
