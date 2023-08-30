<?php

require '../koneksi/koneksi.php';
$title_web = 'Dashboard';
include 'header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
if (!empty($_POST['nama_rental'])) {
    $data[] =  htmlspecialchars($_POST["nama_rental"]);
    $data[] =  htmlspecialchars($_POST["telp"]);
    $data[] =  htmlspecialchars($_POST["alamat"]);
    $data[] =  htmlspecialchars($_POST["email"]);
    $data[] =  htmlspecialchars($_POST["no_rek"]);
    $data[] =  1;
    $sql = "UPDATE infoweb SET nama_rental = ?, telp = ?, alamat = ?, email = ?, no_rek = ?  WHERE id = ? ";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script>alert("Update Data Info Website Berhasil !");window.location="index.php"</script>';
    exit;
}

if (!empty($_POST['nama_pengguna'])) {
    $data[] =  htmlspecialchars($_POST["nama_pengguna"]);
    $data[] =  htmlspecialchars($_POST["username"]);
    $data[] =  md5($_POST["password"]);
    $data[] =  $_SESSION['USER']['id_login'];
    $sql = "UPDATE login SET nama_pengguna = ?, username = ?, password = ? WHERE id_login = ? ";
    $row = $koneksi->prepare($sql);
    $row->execute($data);
    echo '<script>alert("Update Data Profil Berhasil !");window.location="index.php"</script>';
    exit;
}

$result = $koneksi->prepare("SELECT SQL_CALC_FOUND_ROWS id_login FROM login");
$result->execute();
$result = $koneksi->prepare("SELECT FOUND_ROWS()");
$result->execute();
$row_count = $result->fetchColumn();


$result = $koneksi->prepare("SELECT SQL_CALC_FOUND_ROWS id_mobil FROM mobil");
$result->execute();
$result = $koneksi->prepare("SELECT FOUND_ROWS()");
$result->execute();
$row_count_1 = $result->fetchColumn();


$res1 = $koneksi->prepare('SELECT sum(nominal) FROM pembayaran;');
$res1->execute();
$row = $res1->fetch(PDO::FETCH_NUM);
$total = $row[0];

// Menghitung jumlah sopir
$res2 = $koneksi->prepare('SELECT COUNT(*) FROM sopir');
$res2->execute();
$countSopir = $res2->fetchColumn();


?>

<div class="container mt-4">
    <div class="row my-3">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $row_count ?> User</div>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Data Mobil</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $row_count_1 ?> Mobil</div>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Keuangan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total ?></div>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sopir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countSopir ?></div>
                        </div>
                        <div class="col-auto">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-header">Grafik Total Pendapatan</div>
            <div class="card-body">
                <?php
                $pdo = new PDO('mysql:host=localhost;dbname=rentalmobil', 'root', '');
                $sql = "SELECT DATE(tanggal) AS tanggal, SUM(total_harga) AS total_harga_per_hari FROM booking GROUP BY DATE(tanggal)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $labels = array_column($data, 'tanggal');
                $values = array_column($data, 'total_harga_per_hari');
                ?>
                <div id="chart-container">
                    <canvas id="mycanvas"></canvas>
                </div>
                <script>
    var ctx = document.getElementById("mycanvas").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: '',
                data: <?php echo json_encode($values); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Info Website
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        $sql = "SELECT * FROM infoweb WHERE id = 1";
                        $row = $koneksi->prepare($sql);
                        $row->execute();
                        $edit = $row->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="form-group">
                            <label for="">Nama rental</label>
                            <input type="text" class="form-control" value="<?= $edit->nama_rental; ?>" name="nama_rental" id="nama_rental" placeholder="" />
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value="<?= $edit->email; ?>" name="email" id="email" placeholder="" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telp</label>
                                    <input type="text" class="form-control" value="<?= $edit->telp; ?>" name="telp" id="telp" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" placeholder=""><?= $edit->alamat; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">No rek</label>
                            <textarea class="form-control" name="no_rek" id="no_rek" placeholder=""><?= $edit->no_rek; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Profil Admin
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php
                        $id =  $_SESSION["USER"]["id_login"];
                        $sql = "SELECT * FROM login WHERE id_login = ?";
                        $row = $koneksi->prepare($sql);
                        $row->execute(array($id));
                        $edit_profil = $row->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="form-group">
                            <label for="">Nama Pengguna</label>
                            <input type="text" class="form-control" value="<?= $edit_profil->nama_pengguna; ?>" name="nama_pengguna" id="nama_pengguna" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" required class="form-control" value="<?= $edit_profil->username; ?>" name="username" id="username" placeholder="" />
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" required class="form-control" value="" name="password" id="password" placeholder="" />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>