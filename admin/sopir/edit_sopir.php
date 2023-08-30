<?php

require '../../koneksi/koneksi.php';
$title_web = 'Edit Sopir';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
$id = $_GET['id'];

$sql = "SELECT * FROM sopir WHERE id_sopir =  ?";
$row = $koneksi->prepare($sql);
$row->execute(array($id));
$hasil = $row->fetch();
?>


<br>
<div class="container">
    <div class="card">
        <div class="card-header text-white bg-primary">
            <h4 class="card-title">
                Edit Sopir - <?= $hasil['nama_sopir']; ?>
                <div class="float-right">
                    <a class="btn btn-warning" href="sopir.php" role="button">Kembali</a>
                </div>
            </h4>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="post" action="proses_sopir.php?aksi=edit&id=<?= $id; ?>" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-3">ID Sopir</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['id_sopir']; ?>" name="id_sopir" placeholder="Isi Id Sopir">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Nama Sopir</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['nama_sopir']; ?>" name="nama_sopir" placeholder="Isi Nama Sopir">
                            </div>

                            <!-- <div class="form-group row">
                                <label class="col-sm-3">Umur</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['umur']; ?>" name="umur" placeholder="Isi Umur">
                            </div> -->

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-3">Tanggal Lahir</label>
                                <input type="date" class="form-control col-sm-9" value="<?= $hasil['tgl_lahir']; ?>" name="tgl_lahir" placeholder="Isi Tanggal Lahir">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Alamat</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['alamat']; ?>" name="alamat" placeholder="Isi Tanggal Lahir">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Telepon</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['telepon']; ?>" name="telepon" placeholder="Isi Telepon">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="float-right">
                        <button class="btn btn-primary" role="button" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>