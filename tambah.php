<?php
    //buat koneksi
    $conn=mysqli_connect("localhost", "root", "", "phpdatabse");

    // cek apakah button submit sudah di tekan atau belum
    if(isset($_POST['submit'])){
        // ambil data dari tip element dalam form yang disimpan di variable baru
        $Nama = $_POST["Nama"];
        $Nim = $_POST["Nim"];
        $Email = $_POST["Email"];
        $Jurusan = $_POST["Jurusan"];
        $Gambar = $_POST["Gambar"];

        // query insert data
        $query = "  INSERT INTO mahasiswa
                    VALUES
                    ('', '$Nama', '$Nim', '$Email', '$Jurusan', '$Gambar')";
        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            echo " data berhasil disimpan";
        } else {
            echo "gagal!";
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

    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label for="inputName" class="col-sm-1 control-label">Nama : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Nama" placeholder="Masukan Nama" name="Nama">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-1 control-label">NIM : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Nim" placeholder="Masukan NIM"  name="NIM">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Email : </label>
            <div class="col-sm-3">
                <input type="email" class="form-control" id="Email" placeholder="Masukan Email" name="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Jurusan : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Jurusan" placeholder="Masukan Nama Jurusan" name="Jurusan">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">Gambar : </label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="Gambar" placeholder="Masukan Nama Gambar" name="Gambar">
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