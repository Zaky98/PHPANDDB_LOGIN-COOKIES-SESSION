<?php

    require 'function.php';

    if(isset($_POST['register'])){
        if(Registrasi($_POST) > 0) {
            echo "
                <style>
                    alert('User berhasil ditambahkan');
                </style>
            ";
        }else {
            echo mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Form Registrasi </title>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        label {
            display : block;
        }
    </style>
</head>
<body>
    <h1> Halaman Registrasi </h1>

    <br>

    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label for="inputName" class="col-sm-1 control-label">Username : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="username" placeholder="Masukan Username" name="username" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-1 control-label">Password : </label>
            <div class="col-sm-3">
                <input type="password" class="form-control" id="password" placeholder="Masukan Password"  name="password" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-1 control-label">Password : </label>
            <div class="col-sm-3">
                <input type="password" class="form-control" id="password2" placeholder="Masukan ulang password"  name="password2" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-3">
                <button type="submit" class="btn btn-primary" name="register">Registrasi</button>
            </div>
        </div>
    </form>
</body>
</html>