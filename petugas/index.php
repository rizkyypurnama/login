<?php 
	session_start();
    include '../koneksi.php';
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:../login.php?pesan=gagal");
    }

     
	?>
    
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Petugas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
 
</head>
<body>

<div class="container-fluid">
    <div class="row flex-nowrap" style="width:75%">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: black;">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 position-sticky" style="top:0px;">
                <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Kasir Saya</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link align-middle px-0">
                        <i class="fas fa-home"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <br>
                    <div class="nav">
                            <div class="sb-sidenav-menu-heading">MASTER DATA</div>
                           
                            <a class="nav-link" href="data_barang.php">
                                <br>
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                BARANG 
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                PELANGGAN
                            </a>
                            <div class="sb-sidenav-menu">
                                <br>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">TRANSAKSI</div>
                            <a class="nav-link" href="transaksi.php">
                                <br>
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                PENJUALAN
                            </a>
                           
                            <a class="nav-link" href="laporan.php">
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                LAPORAN
                            </a>
                            
                            <a class="nav-link" href="#" data-bs-toggle="modal"
                                    data-bs-target="#logout">
                               LOGOUT
                            </a>
                </ul >
                <hr>
               
            </div>
        </div>
        
        <div class="main-content" style="width:115%">
        <br>
        <br>
        <div class="col py-3">
            <!-- isi -->
            <div class="container">
        <div class="content">
            <div class="card mt-7">
            
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    Data Barang
                                    <?php 
                                    $produk = mysqli_query($koneksi," SELECT COUNT(*) jumpro FROM `produk`");
                                    $jumlahproduk = mysqli_fetch_array($produk);
                                    
                                    $pelanggan = mysqli_query($koneksi," SELECT COUNT(*) jumpel FROM `pelanggan`");
                                    $jumlahpelanggan = mysqli_fetch_array($pelanggan);
                                    
                                    $pengguna = mysqli_query($koneksi," SELECT COUNT(*) jumpeng FROM `user`");
                                    $jumlahpengguna = mysqli_fetch_array($pengguna);

                                    ?>
                                    <h3><?php echo $jumlahproduk['jumpro']?></h3>
                                    <a href="data_barang.php" class="btn btn-outline-primary btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    Data Pelanggan
                                    <h3><?php echo $jumlahpelanggan['jumpel']?></h3>
                                    <a href="pelanggan.php" class="btn btn-outline-primary btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card">
                    <div class="card-body text-center">
                     &copy; Kasir Petugas
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <p>Anda Ingin Keluar Dari Akun Ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <a href="../logout.php" class="btn btn-primary">Ya</a>
                </div>
        </div>
    </div>
</div>
    
    
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>