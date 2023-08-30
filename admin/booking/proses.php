<?php

 require '../../koneksi/koneksi.php';

if($_GET['id'] == 'konfirmasi')
{
    $data2[] = $_POST['status'];
    $data2[] = $_POST['id_booking'];
    $sql2 = "UPDATE `booking` SET `konfirmasi_pembayaran`= ? WHERE id_booking= ?";
    $row2 = $koneksi->prepare($sql2);
    $row2->execute($data2);

    $data3[] = $_POST['id_mobil'];
    $sql3 = "UPDATE `mobil` SET `status`= 'Tidak Tersedia' WHERE id_mobil= ?";
    $row3 = $koneksi->prepare($sql3);
    $row3->execute($data3);

    echo '<script>alert("Kirim Sukses , Pembayaran berhasil");history.go(-1);</script>'; 
}