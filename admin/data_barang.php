<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../login.php?pesan=gagal");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Admin</title>
    <script defer src="../js/skrp/a.js"></script>
    <script defer src="../js/skrp/b.js"></script>
    <script defer src="../js/skrp/v.js"></script>
    <script defer src="../js/skrp/script.js"></script>
   <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">
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
                            <a class="nav-link" href="data_pengguna.php">
                                <br>
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                PETUGAS
                            </a>
                            <a class="nav-link" href="data_barang.php">
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
        <div class="col py-3">
            <!-- isi -->
            <div class="container">
        <div class="content">
            <div class="card mt-5">
                <div class="card-body">
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body ">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#tambah-data">
                                    Tambah Data
                                    </button>
                                   </div>
                                   
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="example">
                        <thead>
                            <th><div align="center">No</div></th>
                            <th><div align="center">Nama Produk</div></th>
                            <th><div align="center">Harga</div></th>
                            <th><div align="center">Stok</div></th>
                            <th><div align="center">Option</div></th>
                        </thead>
                        <tbody>
                        <?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"SELECT * FROM produk");
		while($d = mysqli_fetch_array($data)){
			?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><?php echo $d['NamaProduk']; ?></td>
                                <td align="center"><?php echo $d['Harga']; ?></td>
                                <td align="center"><?php echo $d['Stok']; ?></td>
                                <td align="center">
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#hapus-data<?php echo $d['ProdukID']; ?>">
                                    <i class="fa fa-trash fa-fw"></i>
                                    hapus
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-data<?php echo $d['ProdukID']; ?>">
                                    <i class="fa fa-edit fa-fw"></i>
                                    edit
                                    </button>
                                </td>
                            </tr>
<div class="modal fade" id="edit-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="proses_update_barang.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="hidden" name="ProdukID" 
                        value="<?php echo $d['ProdukID']; ?>">
                        <input type="text" name="NamaProduk" class="form-control" value="<?php echo $d['NamaProduk']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" name="Harga" class=
                        "form-control" value="<?php echo $d['Harga']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Stok Barang</label>
                        <input type="number" name="Stok" class=
                        "form-control" value="<?php echo $d['Stok']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="hapus-data<?php echo $d['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="proses_hapus_barang.php">
      <div class="modal-body">
        <input type="hidden" name="ProdukID" value="<?php echo $d['ProdukID']; ?>">
           Apakah anda yakin 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Hapus</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses_simpan_barang.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="NamaProduk"  required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" name="Harga"  required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Stok Barang</label>
                        <input type="number" name="Stok"  required="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
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
