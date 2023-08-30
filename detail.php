<?php

    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
    $id = strip_tags($_GET['id']);
    $hasil = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<div class="container mt-5">
<div class="row">
    <div class="col-sm-6">
        <img class="card-img-top w-100" 
            style="object-fit:cover;" 
            src="assets/image/<?php echo $hasil['gambar'];?>" alt="">
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $hasil['merk'];?></h4>
                <h4 class="card-title"><?php echo $hasil['tipe'];?></h4>
                <h4 class="card-title"><?php echo $hasil['transmisi'];?></h4>
                <p class="card-text">
                    Deskripsi :
                    <?php echo $hasil['deskripsi'];?>
                </p>
                <ul class="list-group list-group-flush">
                    <?php if($hasil['status'] == 'Tersedia'){?>
                    <li class="list-group-item bg-primary text-white">
                        <i class="fa fa-check"></i> ?Tersedia
                    </li>
                    <?php }else{?>
                    <li class="list-group-item bg-danger text-white">
                        <i class="fa fa-close"></i> Tidak Tersedia
                    </li>
                    <?php }?>
                    <li class="list-group-item bg-dark text-white">
                        <i class="fa fa-money"></i> Rp. <?php echo number_format($hasil['harga']);?>/ jam
                    </li>
                </ul>
                <hr/>
                <center>
                    <a href="booking.php?id=<?php echo $hasil['id_mobil'];?>" class="btn btn-success">Booking Sekarang!</a>
                    <a href="index.php" class="btn btn-info">Kembali</a>
                </center>
            </div>
         </div> 
    </div>
</div>
</div>


<?php include 'footer.php';?>