<?php

require '../../koneksi/koneksi.php';
$title_web = 'Tambah Sopir';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
?>


<br>
<div class="container">
    <div class="card">
        <div class="card-header text-white bg-primary">
            <h4 class="card-title">
                Tambah Sopir
                <div class="float-right">
                    <a class="btn btn-warning" href="sopir.php" role="button">Kembali</a>
                </div>
            </h4>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="get" action="proses_sopir.php" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-3">Id Sopir</label>
                                <input type="text" class="form-control col-sm-9" name="id_sopir" placeholder="Isi Id Sopir">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Nama Sopir</label>
                                <input type="text" class="form-control col-sm-9" name="nama_sopir" placeholder="Isi Nama Sopir">
                            </div>

                            <!-- <div class="form-group row">
                                <label class="col-sm-3">Umur</label>
                                <input type="text" class="form-control col-sm-9" name="umur" placeholder="Isi Umur">
                            </div> -->

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label class="col-sm-3">Alamat</label>
                                <input type="text" class="form-control col-sm-9" name="alamat" placeholder="Isi Alamat">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Tanggal Lahir</label>
                                <input type="date" class="form-control col-sm-9" name="tgl_lahir">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Telepon</label>
                                <input type="text" class="form-control col-sm-9" name="telepon" placeholder="Isi telepon">

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="float-right">
                        <button type="submit" class="btn btn-success" href="proses_sopir.php" role="button" name="submit">Simpan</button>
                    <!-- <a class="btn btn-success" href="proses_sopir.php" role="button">Simpan</a> -->
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>