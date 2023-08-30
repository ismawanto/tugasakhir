<?php

session_start();
require 'koneksi/koneksi.php';
include 'header.php';
if (empty($_SESSION['USER'])) {
    echo '<script>alert("Harap login !");window.location="index.php"</script>';
}
$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

$idMobil = $hasil['id_mobil'];
$isiMobil = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$idMobil'")->fetch();

$idSupir = $hasil['id_sopir']; // Ambil ID supir dari hasil booking
$dataSupir = $koneksi->query("SELECT * FROM sopir WHERE id_sopir = '$idSupir'")->fetch(); // Ambil data supir

$unik = random_int(100, 999);
?>

<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Pembayaran Dapat Melalui :</h5>
                    <hr />
                    <p><?= $info_web->no_rek; ?></p>
                    <h5>Wajib Dibayar Sebelum</h5>
                    <h4 class="text-danger"><?php $tanggal = strtotime($hasil['tgl_input']);
$tanggal = strtotime("+1 day", $tanggal);
$tanggal = strtotime("23:59", $tanggal);
$batas_waktu = date('Y-m-d H:i:s', $tanggal);
echo date('Y-m-d H:i:s', $tanggal);

                    ?></h4>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-body" style="background:#ddd">
                    <h5 class="card-title"><?php echo $isiMobil['merk']; ?></h5>
                </div>
                <ul class="list-group list-group-flush">

                    <?php if ($isiMobil['status'] == 'Tersedia') { ?>

                        <li class="list-group-item bg-primary text-white">
                            <i class="fa fa-check"></i> TERSEDIA
                        </li>

                    <?php } else { ?>

                        <li class="list-group-item bg-danger text-white">
                            <i class="fa fa-close"></i> TIDAK TERSEDIA
                        </li>

                    <?php } ?>
        
                    <li class="list-group-item bg-dark text-white">
                        <i class="fa fa-money"></i> Rp. <?php echo number_format($isiMobil['harga']); ?>/ jam
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Kode Booking </td>
                            <td> :</td>
                            <td><?php echo $hasil['kode_booking']; ?></td>
                        </tr>
                        <tr>
                            <td>KTP </td>
                            <td> :</td>
                            <td><?php echo $hasil['ktp']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama </td>
                            <td> :</td>
                            <td><?php echo $hasil['nama']; ?></td>
                        </tr>
                        <tr>
                            <td>telepon </td>
                            <td> :</td>
                            <td><?php echo $hasil['no_tlp']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Ambil </td>
                            <td> :</td>
                            <td><?php echo $hasil['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <td>Lama Sewa  </td>
                            <td> :</td>
                            <td><?php echo $hasil['lama_sewa']; ?>/ jam</td>
                        </tr>
                        <tr>
                            <td>Total Harga </td>
                            <td> :</td>
                            <td>Rp. <?php echo number_format($hasil['total_harga']); ?></td>
                        </tr>
                        <tr>
                            <td>Status </td>
                            <td> :</td>
                            <td><?php echo $hasil['konfirmasi_pembayaran']; ?></td>
                        </tr>
                        <?php if ($idSupir) { ?>
                            <tr>
                                <td>Supir </td>
                                <td> :</td>
                                <td><?php echo $dataSupir['nama_sopir']; ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                    <?php if ($hasil['konfirmasi_pembayaran'] == 'Belum Bayar') {
                        if (time() < strtotime($batas_waktu)) {
                            echo '<a href="konfirmasi.php?id=' . $kode_booking . '" class="btn btn-primary float-right">Konfirmasi Pembayaran</a>';
                        } else {
                            echo '<button class="btn btn-primary float-right" disabled>Konfirmasi Pembayaran</button>';
                        }
                     } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

<?php include 'footer.php'; ?>