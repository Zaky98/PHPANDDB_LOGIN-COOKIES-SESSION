<?php

    //membuat koneksi
    $conn=mysqli_connect("localhost", "root", "", "phpdatabse");

    // //ambil data dari tabel mahasiswa/query data mahasiswa
    // $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    // var_dump ($result);

    // //ambil data dari tabel mahasiswa/query data mahasiswa
    // $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    // $mhs = mysqli_fetch_row($result);
    // var_dump ($result);

    // //ambil data dari tabel mahasiswa/query data mahasiswa
    // $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    // $mhs = mysqli_fetch_assoc($result);
    // var_dump ($mhs);

    // //ambil data dari tabel mahasiswa/query data mahasiswa
    // $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    // $mhs = mysqli_fetch_array($result);
    // var_dump ($mhs);

    // //ambil data dari tabel mahasiswa/query data mahasiswa
    // $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    // $mhs = mysqli_fetch_object($result);
    // var_dump ($mhs->Nama);

    // //ambil data dari tabel mahasiswa/query data mahasiswa
    // $result=mysqli_query($conn,"SELECT * FROM mahasiswa");
    // while($mhs = mysqli_fetch_assoc($result))
    // {
    //     var_dump ($mhs);
    // }

    //ambil data dari tabel mahasiswa/query data mahasiswa
    $result=mysqli_query($conn,"SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html leng = "en">
<head>
    <title> Document </title>
</head>
<body>
    <h1> Daftar Mahasiswa </h1>

    <table border = "1" cellpadding = "10" cellspacing = "0">

    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Nim</th>
        <th>Email</th>
        <th>Jurusan</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php $i = 1 ?>
    
    <!-- //kita biat contoh data static -->

    <?php while ($row=mysqli_fetch_assoc($result)):?>

    <tr>

        <td><?= $i; ?></td>
        <td><?= $row["Nama"];?></td>
        <td><?= $row["Nim"];?></td>
        <td><?= $row["Email"];?></td>
        <td><?= $row["Jurusan"];?></td>
        <td> <img src="img/<?php echo $row["Gambar"]; ?>" alt="" srcset="" width=100 height=50></td>
        <td>
            <a href = ""> Edit </a>
            <a href = ""> Hapus </a>
        </th>

    </tr> 
    <?php $i++ ?>
    <?php endwhile; ?>
    
</body>
</html>