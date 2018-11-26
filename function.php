<?php

    //membuat koneksi
    $conn=mysqli_connect("localhost", "root", "", "phpdatabse");

    if(!$conn){
        die('Koneksi Error : '.mysqli_connect_errno()
        .' - '.mysqli_connect_error());
    }

    //ambil data dari tabel mahasiswa/query data mahasiswa
    $result=mysqli_query($conn,"SELECT * FROM mahasiswa");

    //function query akan menerima isi parameter dari string query yang ada pada index2.php (line 3)
    function query($query_kedua){
        //dikarena $conn diluar function query maka dibutuhkan scope global $$conn

        global $conn;
        $result = mysqli_query($conn, $query_kedua);

        //wadah kosong untuk menampung isi array pada saat looping line 16

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah ($data) {
        global $conn;

        $Nama = htmlspecialchars($_POST["Nama"]);
        $Nim = htmlspecialchars($_POST["Nim"]);
        $Email = htmlspecialchars($_POST["Email"]);
        $Jurusan = htmlspecialchars($_POST["Jurusan"]);
        // $Gambar = htmlspecialchars($_POST["Gambar"]);

        $Gambar = upload();
        if(!$Gambar){
            return false;
        }
       
        $query = "  INSERT INTO mahasiswa
                    VALUES
                    ('','$Nama','$Nim','$Email','$Jurusan','$Gambar')";
        
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
        
    }

    function hapus ($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id =$id");
        return mysqli_affected_rows($conn);
    }

    function edit ($data){
        global $conn;

        $id = $data["id"];
        
        $Nama = htmlspecialchars($data["Nama"]);
        $Nim = htmlspecialchars($data["Nim"]);
        $Email = htmlspecialchars($data["Email"]);
        $Jurusan = htmlspecialchars($data["Jurusan"]);
        $Gambarlama = htmlspecialchars($data["Gambarlama"]);

        //cek apakah user menekan button browse
        if($_FILES['Gambar'][error] === 4){
            $Gambar = $Gambarlama;
        } else {
            $Gambar = upload();
        }
        
        $query = " UPDATE mahasiswa SET
                    Nama = '$Nama',
                    Nim = '$Nim',
                    Email = '$Email',
                    Jurusan = '$Jurusan',
                    Gambar = '$Gambar'
                    WHERE id = $id";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function cari($keyword){

        $sql = "SELECT * FROM mahasiswa
                WHERE
                Nama LIKE '%$keyword%' OR
                Nim LIKE '%$keyword%' OR
                Email LIKE '%$keyword%' OR
                Jurusan LIKE '%$keyword%' 
                ";

                return query($sql);
    }

    function upload() {
    
        $Nama_file   = $_FILES['Gambar']['name'];
        $Ukuran_file = $_FILES['Gambar']['size'];
        $Error       = $_FILES['Gambar']['error'];
        $Tmpfile     = $_FILES['Gambar']['tmp_name'];

        if($Error===4){
            //pastikan pada inputan gambar tidak terdapat atribut required

            echo "
                <script>
                    alert('Tidak ada gambar diupload');
                </script>
            ";
            return false;
        }

        $Jenis_gambar = ['jpg', 'jpeg', 'gif'];
        $Pecah_gambar = explode('.', $Nama_file);
        $Pecah_gambar = strtolower(end($Pecah_gambar));
        if(!in_array($Pecah_gambar, $Jenis_gambar)){
            echo "
                <script>
                    alert('Yang anda upload bukan file gambar');
                </script>
            ";
            return false;
        }


        //cek kapasitass gambar dalam byte, kalau 1000000 byte = 1mb

        if($Ukuran_file > 1000000){
            echo "
                <script>
                    alert('Ukuran gambar terlalu besar');
                </script>
            ";
            return false;
        }

        //generate id untuk penamaan gambar dengan function uniqid()

        $Namafilebaru = uniqid();
        $Namafilebaru .= '.';
        $Namafilebaru .= $Pecah_gambar; 

        move_uploaded_file($Tmpfile, 'img/'. $Namafilebaru);

        //kita return nama filenya agar dapat masuk ke $Gambar=$upload() pada function tambah
        return $Namafilebaru;

    }

    function registrasi($data){

        global $conn;

        //stripclashes digunakan untuk enghilangkan blackslashes
        $username = strtolower(stripcslashes($data['username']));

        $password = mysqli_real_escape_string($conn, $data['password']);
        $password2 = mysqli_real_escape_string($conn, $data['password2']);

        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

        //cek kondisi jika line 175 nilai true maka cetak echo
        if(mysqli_fetch_assoc($result)){
            echo "
                <script>
                    alert('Username sudah ada');
                </script>
            ";
            return false;
        }
        
        //cek konfirmasi pasword
        if($password !== $password2){
            echo "
                <script>
                    alert('Password anda tidak sama');
                </script>
            ";
            return false;
        }

        // $password = md5($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        var_dump($password);

        mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");

        return mysqli_affected_rows($conn);
    }

?>