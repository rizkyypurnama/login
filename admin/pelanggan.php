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
                                  
                    <table class="table table-striped table-bordered table-hover" id="example">
                        <thead>
                            <th><div align="center">No</div></th>
                            <th><div align="center">Id Pelanggan</div></th>
                            <th><div align="center">Nama Pelanggan</div></th>
                            <th><div align="center">Alamat</div></th>
                            <th><div align="center">No Telepon</div></th>
                            <th><div align="center">Option</div></th>
                        </thead>
                        <tbody>
                        <?php 
                        include '../koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><?php echo $d['PelangganID']; ?></td>
                                <td align="center"><?php echo $d['NamaPelanggan']; ?></td>
                                <td align="center"><?php echo $d['Alamat']; ?></td>
                                <td align="center"><?php echo $d['NomorTelepon']; ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>">
                                    <i class="fa fa-trash fa-fw"></i>
                                    Hapus
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#edit-data<?php echo $d['PelangganID']; ?>">
                                    <i class="fa fa-edit fa-fw"></i>
                                    Edit
                                    </button>
                                </td>
                            </tr>
<div class="modal fade" id="edit-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="proses_update_pelanggan.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Id Pelanggan</label>
                        <input type="text" name="PelangganID" readonly value="<?php echo $d['PelangganID']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="NamaPelanggan" value="<?php echo $d['NamaPelanggan']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="Alamat" value="<?php echo $d['Alamat']; ?>"class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="number" name="NomorTelepon" value="<?php echo $d['NomorTelepon']; ?>" class="form-control">
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
<div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="proses_hapus_pelanggan.php">
      <div class="modal-body">
        <input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
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
    <div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses_pelanggan.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="NamaPelanggan" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="Alamat" required="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="number" name="NomorTelepon" required="" class="form-control">
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
