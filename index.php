<?php
    session_start();

    if(!isset($_SESSION["login"])){
        echo $_SESSION["login"];
        header("location:login.php");
        exit;
    }

    require 'function.php';
    $mahasiswa = query("SELECT * FROM mahasiswa");
    
    if(isset($_POST["cari"])){
        $mahasiswa = cari($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html leng = "en">
<head>
    <title> Document </title>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>

    <h1><center> Daftar Mahasiswa </h1>

    <br>

    <table border = "1" cellpadding = "10" cellspacing = "0" class="table table-bordered">

    <thead>
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Nim</th>
        <th>Email</th>
        <th>Jurusan</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
    </thead>
    

    <!-- //kita biat contoh data static -->

    <?php $i=1 ?>
    
    <?php foreach ($mahasiswa as $row): ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["Nama"];?></td>
        <td><?= $row["Nim"];?></td>
        <td><?= $row["Email"];?></td>
        <td><?= $row["Jurusan"];?></td>
        <td> <img src="img/<?php echo $row["Gambar"]; ?>" alt="" srcset="" width=100 height=50></td>
        <td>
            <a href = "edit.php?id=<?php echo $row["id"];?>"> Edit </a>
            <a href = "hapus.php?id=<?php echo $row["id"]; ?>"onclick="return confirm('Apakah data ini akan dihapus?')">Hapus </a>
        </td>
    </tr>
    <?php $i++ ?>
    <?php endforeach;?>
    </table>

    <form class="form-inline" action="" method="post">
		<div class="form-group">
            <input type="text" name="keyword" size="40" autofocus placeholder="Masukan keyword pencarian" autocomplete="off">
		</div>		
		    <button type="submit" class="btn btn-primary" name="cari">Cari</button>
	</form>
    
    <br>
    <a href="tambah_data.php" class="btn btn-primary">Tambah data mahasiswa</a>
    <a href="logout.php" class="btn btn-primary">Logout</a>
    
</body>
</html>