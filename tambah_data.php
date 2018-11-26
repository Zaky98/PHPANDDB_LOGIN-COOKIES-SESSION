<?php

    session_start();

    if(!isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header("location:login.php");
        exit;
    }
    
    require 'function.php';

    // cek apakah button submit sudah di tekan atau belum
    if(isset($_POST['submit'])){
        
        // cek isi dari post menggunakan vardump
        // var_dump($_POST);
        // var_dump($_FILES);
        // die();
        
        if(tambah($_POST) > 0){
            echo "
            <script>
                alert('data berhasil disimpan');
                document.location.href='index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal disimpan');
                document.location.href='tambah_data.php';
            </script>";
            echo "<br>";
            echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Tambah Data</title>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <br>

     <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName" class="col-sm-1 control-label">Nama : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Nama" placeholder="Masukan Nama" name="Nama" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-1 control-label">NIM : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Nim" placeholder="Masukan NIM"  name="Nim" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Email : </label>
            <div class="col-sm-3">
                <input type="email" class="form-control" id="Email" placeholder="Masukan Email" name="Email" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Jurusan : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Jurusan" placeholder="Masukan Nama Jurusan" name="Jurusan" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Gambar : </label>
            <div class="col-sm-3">
                <input type="file" class="form-control" id="Gambar" placeholder="Masukan Nama Gambar" name="Gambar" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-3">
                <button type="submit" class="btn btn-primary" name="submit">TAMBAH DATA</button>
            </div>
        </div>
    </form>

</body>
</html>