<?php

require '../../koneksi/koneksi.php';
$title_web = 'Daftar Sopir';
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
                Daftar Sopir
                <div class="float-right">
                    <a class="btn btn-success" href="tambah_sopir.php" role="button">Tambah</a>
                </div>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id Sopir</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Umur</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM sopir";
                        $row = $koneksi->prepare($sql);
                        $row->execute();
                        $hasil = $row->fetchAll();
                        $no = 1;

                        foreach ($hasil as $isi) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
								
                                <td><?php echo $isi['nama_sopir']; ?></td>
                               
                                <td><?php echo $isi['alamat']; ?></td>
                                <td><?php echo $isi['tgl_lahir']; ?></td>
                                <td>
                                <?php
                                $dateOfBirth =  $isi['tgl_lahir'];
 
                                // Create a datetime object using date of birth
                                $dob = new DateTime($dateOfBirth);
                                 
                                // Get current date
                                $now = new DateTime();
                                 
                                // Calculate the time difference between the two dates
                                $diff = $now->diff($dob);
                                 
                                // Get the age in years, months and days
                                echo $diff->y;
                                   ?>
                                </td>
                                <td><?php echo $isi['telepon']; ?></td>

                                <td>
                                    <a class="btn btn-primary btn-sm" href="edit_sopir.php?id=<?php echo $isi['id_sopir']; ?>" role="button">Edit</a>
                                    <a class="btn btn-danger  btn-sm" href="proses_sopir.php?aksi=hapus&id=<?= $isi['id_sopir']; ?>&nama_sopir=<?= $isi['nama_sopir']; ?>" role="button">Hapus</a>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>