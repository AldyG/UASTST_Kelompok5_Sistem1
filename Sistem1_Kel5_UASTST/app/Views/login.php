<?php include('header.php'); ?>

<div class="container">
    <h1>Login Dosen</h1>
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
