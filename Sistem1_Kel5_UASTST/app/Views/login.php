<?php include('header.php'); ?>

<div class="container">
    <h1>Login Dosen</h1>
    <form action="/login" method="post">
        <div class="form-group">
            <label for="NIDN">NIDN</label>
            <input type="text" class="form-control" name="NIDN" id="NIDN" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include('footer.php'); ?>
