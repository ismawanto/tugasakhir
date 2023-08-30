<?php

session_start();
if (!empty($_SESSION['USER']['level'] == 'admin')) {
} else {
    echo '<script>alert("Login Khusus Admin !");window.location="../index.php";</script>';
}

// select untuk panggil nama admin
$id_login = $_SESSION['USER']['id_login'];

$row = $koneksi->prepare("SELECT * FROM login WHERE id_login=?");
$row->execute(array($id_login));
$hasil_login = $row->fetch();
?>

<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title_web; ?> | Rental Mobil</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?php echo $url; ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url; ?>assets/css/font-awesome.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        #chart-container {
            width: 640px;
            height: auto;
        }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>

<body>
    <div class="jumbotron pt-4 pb-4">
        <div class="row">
            <div class="col-sm-8">
                <h2><b style="text-transform:uppercase;">Dalem Mobil</h2>
            </div>
        </div>
    </div>
    <div style="margin-top:-2pc"></div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #333;">
        <a class="navbar-brand" href="<?php echo $url; ?>admin/"><b>Admin Panel</b></a>
        <button class="navbar-toggler text-white d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation" style="color:#fff;">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item <?php if ($title_web == 'Dashboard') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="<?php echo $url; ?>admin/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if ($title_web == 'User') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="<?php echo $url; ?>admin/user/index.php">User / Pelanggan</a>
                </li>
                <li class="nav-item <?php if ($title_web == 'Daftar Mobil') {
                                        echo 'active';
                                    } ?>
                <?php if ($title_web == 'Tambah Mobil') {
                    echo 'active';
                } ?>
                <?php if ($title_web == 'Edit Mobil') {
                    echo 'active';
                } ?>">
                    <a class="nav-link" href="<?php echo $url; ?>admin/mobil/mobil.php">Daftar Mobil</a>
                </li>
                <li class="nav-item <?php if ($title_web == 'Daftar Sopir') {
                                        echo 'active';
                                    } ?>
                <?php if ($title_web == 'Tambah Sopir') {
                    echo 'active';
                } ?>
                <?php if ($title_web == 'Edit Sopir') {
                    echo 'active';
                } ?>">
                    <a class="nav-link" href="<?php echo $url; ?>admin/sopir/sopir.php">Daftar Sopir</a>
                </li>
                <li class="nav-item <?php if ($title_web == 'Daftar Booking') {
                                        echo 'active';
                                    } ?>
                <?php if ($title_web == 'Konfirmasi') {
                    echo 'active';
                } ?>">
                    <a class="nav-link" href="<?php echo $url; ?>admin/booking/booking.php">Daftar Booking</a>
                </li>
                <li class="nav-item <?php if ($title_web == 'Peminjaman') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="<?php echo $url; ?>admin/peminjaman/peminjaman.php">Peminjaman / Pengembalian</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-user"> </i> Hallo, <?php echo $hasil_login['nama_pengguna']; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Apakah anda ingin Keluar ?');" href="<?php echo $url; ?>admin/logout.php">Keluar</a>
                </li>
            </ul>
        </div>
    </nav>