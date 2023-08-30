<?php

require '../../koneksi/koneksi.php';
$title_web = 'Tambah Sopir';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

// var_dump($_GET);
if(isset($_GET['submit'])){
    $data[] = $_GET['id_sopir'];
    $data[] = $_GET['nama_sopir'];
    // $data[] = $_GET['umur'];
    $data[] = $_GET['alamat'];
    $data[] = $_GET['tgl_lahir'];
    $data[] = $_GET['telepon'];


    $sql = "INSERT INTO `sopir`(`id_sopir`, `nama_sopir`, `alamat`, `tgl_lahir`, `telepon`) 
        VALUES (?,?,?,?,?)";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script>alert("sukses");window.location="sopir.php"</script>';
    

        //   $id = $GET['id_sopir'];
        // $namaSopir = $GET['nama_sopir'];
        // $umur = $GET['umur'];
        // $alamat = $GET['alamat'];
        // $tanggalLahir = $GET['tgl_lahir'];
        // $telepon = $GET['telepon'];
        // $sql = "INSERT INTO sopir (id_sopir, nama_sopir, umur, alamat, tgl_lahir, telepon) 
        //             VALUES (?, ?, ?, ?, ?, ?);";

        // try {
        //     $statement = $koneksi->prepare($sql);
        //     $statement->bindParam(':id_sopir', $id);
        //     $statement->bindParam(':nama_sopir', $namaSopir);
        //     $statement->bindParam(':umur', $umur);
        //     $statement->bindParam(':alamat', $alamat);
        //     $statement->bindParam(':tgl_lahir', $tanggalLahir);
        //     $statement->bindParam(':telepon', $telepon);
       

        //     if ($statement->execute()) {
        //         echo '<script>alert("Data berhasil disimpan");window.location="sopir.php"</script>';
        //     } else {
        //         echo '<script>alert("Gagal menyimpan data");window.location="sopir.php"</script>';
        //     }
        // } catch (PDOException $e) {
        //     echo "Error: " . $e->getMessage();
        // }        

}

// if ($_GET['aksi'] == 'tambah') {
//     $idSopir = $_POST['id_sopir'];
//     $namaSopir = $_POST['nama_sopir'];
//     $umur = $_POST['umur'];
//     $alamat = $_POST['alamat'];
//     $tanggalLahir = $_POST['tgl_lahir'];
//     $telepon = $_POST['telepon'];

//     $sql = "INSERT INTO sopir (id_sopir, nama_sopir, umur, alamat, tgl_lahir, telepon) 
//             VALUES (idSopir, namaSopir, umur, alamat, tanggalLahir, telepon);"

// try {
//     $statement = $koneksi->prepare($sql);
//     $statement->bindParam(':id_sopir', $idSopir);
//     $statement->bindParam(':nama_sopir', $namaSopir);
//     $statement->bindParam(':umur', $umur);
//     $statement->bindParam(':alamat', $alamat);
//     $statement->bindParam(':tgl_lahir', $tanggalLahir);
//     $statement->bindParam(':telepon', $telepon);

//     if ($statement->execute()) {
//         echo '<script>alert("Data berhasil disimpan");window.location="sopir.php"</script>';
//     } else {
//         echo '<script>alert("Gagal menyimpan data");window.location="sopir.php"</script>';
//     }
// }


if ($_GET['aksi'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil nilai dari input form
    $id_sopir = $_POST['id_sopir'];
    $nama_sopir = $_POST['nama_sopir'];
    // $umur = $_POST['umur'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    // Mengupdate data ke dalam tabel sopir
    $sql = "UPDATE sopir SET nama_sopir = :nama_sopir,  tgl_lahir = :tgl_lahir, telepon = :telepon,  alamat = :alamat WHERE id_sopir = :id_sopir";

    try {
        $statement = $koneksi->prepare($sql);
        $statement->bindParam(':id_sopir', $id_sopir);
        $statement->bindParam(':nama_sopir', $nama_sopir);
        // $statement->bindParam(':umur', $umur);
        $statement->bindParam(':tgl_lahir', $tgl_lahir);
        $statement->bindParam(':alamat', $alamat);
        $statement->bindParam(':telepon', $telepon);
    

        if ($statement->execute()) {
            echo '<script>alert("Data berhasil diupdate");window.location="sopir.php"</script>';
        } else {
            echo '<script>alert("Gagal mengupdate data");window.location="sopir.php"</script>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


if (!empty($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    unlink('../../assets/image/' . $gambar);

    $sql = "DELETE FROM sopir WHERE id_sopir = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script>alert("sukses hapus");window.location="sopir.php"</script>';
}
