<?php

session_start();

    if(isset($_COOKIE["login"])){
        if($_COOKIE["login"] == 'true'){
            $_SESSION['login'] = true;
        }
    }

    if(isset($_SESSION["login"])){
        header("location:index.php");
        exit;
    }

    if(isset($_COOKIE['id']) && isset($_COOKIE['username'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id'");
        $row = mysqli_fetch_assoc($result);

        if($key === hash('sha256', row['username'])){
            $_SESSION['login'] = true;
        }
    }

require 'function.php';

if(isset($_POST["login"])) {
    $username=$_POST["username"];
    $password=$_POST["password"];
    

    $result = mysqli_query($conn, "SELECT * FROM user where username = '$username'");

    if(mysqli_num_rows($result) === 1){

        // var_dump($result);
        $row = mysqli_fetch_assoc($result);
        // var_dump(password);
    
        if(password_verify($password, $row["password"])){

            $_SESSION["login"] = true;

            if(isset($_POST['remember'])){
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash(sha256, $row['username']), time()+60);
            }

            header("location:index.php");
            exit;
        }   
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Form Login </title>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <style>
        label {
            display : block;
        }
    </style>
</head>
<body>
    <h1> Halaman Login </h1>

    <br>

    <?php if(isset($error)):?>

        <p style = "color: red; font-style=bold">
        Username dan password salah </p>

    <?php endif?>

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
            <label for="remember" class="col-sm-1 control-label"></label>
            <div class="col-sm-3">
                <input type="checkbox" id="remember" placeholder="Masukan Password"  name="remember">
                <label for="remember">Remember me</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-3">
                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </div>
        </div>
    </form>
</body>
</html>