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
        
        if(edit($_POST) > 0){
            echo "
            <script>
                alert('data berhasil diperbaharui');
                document.location.href='index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal diperbaharui');
                document.location.href='edit.php';
            </script>";
            echo "<br>";
            echo mysqli_error($conn);
        }
    }
?>

<?php
    $id=$_GET["id"];
    // var_dump($id);

    $mhs=query("SELECT * FROM mahasiswa where id=$id")[0];

    // //  var_dump($mhs);
    // var_dump($mhs[0]["Nama"]);
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Update Data</title>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
    <h1>Update Data Mahasiswa</h1>
    <br>

     <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <li>
            <input type="hidden" name="id" value="<?= $mhs["id"]?>">
            <input type = "hidden" name = "Gambarlama" value="<?= mhs[Gambar]; ?>">
        </li>
        <div class="form-group">
            <label for="inputName" class="col-sm-1 control-label">Nama : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Nama" placeholder="Masukan Nama" name="Nama" required value="<?= $mhs["Nama"];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-1 control-label">NIM : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Nim" placeholder="Masukan NIM"  name="Nim" required value="<?= $mhs["Nim"];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Email : </label>
            <div class="col-sm-3">
                <input type="email" class="form-control" id="Email" placeholder="Masukan Email" name="Email" required value="<?= $mhs["Email"];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Jurusan : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Jurusan" placeholder="Masukan Nama Jurusan" name="Jurusan" 
                required value="<?= $mhs["Jurusan"];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Gambar : </label>
            <div class="col-sm-3">
                <input type="file" class="form-control" id="Gambar" name="Gambar">
                <img src = "img/ <?= mhs["Gambar"]; ?>" alt="" height="100" width="100">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-3">
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </div>
        </div>
    </form>

</body>
</html>


