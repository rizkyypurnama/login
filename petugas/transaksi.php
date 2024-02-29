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
    <title>Halaman Petugas</title>
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
                        <br>
                    </li>
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
          <div class="card mt-5">
                <div class="card-body">
  <div >
  <div class="card">
  <div class="card-body">

    <table class="table table-striped table-hover" id="example">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../koneksi.php';
        $query = mysqli_query($koneksi, "SELECT * FROM produk");
        $no = 0;
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <?php $no++ ?>
          <tr>
            <td>  <?php echo $no; ?> </td>
            <td>  <?php echo $data['NamaProduk'];?> </td>
            <td>  <?php echo $data['Harga'];?> </td>
            <td>  <?php echo $data['Stok'];?>  </td>
            <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pilihmodal<?php echo $data['ProdukID']; ?>">
            Pilih
          </button>
            </td>
          </tr>
          <div class="modal fade" id="pilihmodal<?php echo $data['ProdukID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pilih Barang</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
        <form action="proses_transaksi.php" method="POST">
        Nama Produk: <span id="nama-produk"><?php echo $data['NamaProduk']; ?></span><br>
        Stok: <span id="stok"><?php echo $data['Stok']; ?></span>
      </div>
      <div class="form-group">
                       <center> <label for="">Qty</label></center>
                        <input type="number" name="JumlahProduk" class="form-control">
                        <input type="text" name="ProdukID"  hidden value="<?php echo $data['ProdukID']; ?>" class="form-control">
                      </div>
                      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>

      </div>
    </div>
  </div>
</div>
          <?php
        }
        ?>
        
      </tbody>
      
</table>

    </table>
  </div>
</div>
</div>
                    <table class="table table-striped table-bordered table-hover">
                        <br>
                        <thead>
                            <th><div align="center"></div>No</th>
                            <th><div align="center">Nama Produk</div></th>
                            <!-- <th><div align="center">Stok</div></th> -->
                            <th><div align="center">Qty</div></th>
                            
                            <th><div align="center">subtotal</div></th>
                            <th><div align="center">Aksi</div></th>
                        </thead>
                        <tbody>
                        <?php 
                        include '../koneksi.php';
                        $no = 1;
                        $data = mysqli_query($koneksi, "SELECT * FROM keranjang INNER JOIN produk ON keranjang.produkid = produk.ProdukID order by keranjang.keranjangid asc");
                        while($d = mysqli_fetch_array($data)){
                        ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><?php echo $d['NamaProduk']; ?></td>
                                <!-- <td align="center"><?php echo $d['Stok']; ?></td> -->
                                <td align="center"><?php echo $d['jumlahproduk']; ?></td>
                                <td align="center"><?php echo $d['subtotal']; ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#hapus-data<?php echo $d['keranjangid']; ?>">
                                    Hapus
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
                        <input type="text" name="PelangganID" value="<?php echo $d['PelangganID']; ?>" class="form-control">
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
<div class="modal fade" id="hapus-data<?php echo $d['keranjangid']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="proses_hapus_detail.php">
      <div class="modal-body">
        <input type="hidden" name="keranjangid" value="<?php echo $d['keranjangid']; ?>">
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
                    <div class="card">
                        <div class="card-body">
                            <form action="proses_simpan_transaksi.php" method="post">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                            <select name="PelangganID" id="pelanggan" required="" class="form-control">
                            <option selected hidden value="">Pelanggan</option>
                            <?php
                            $idpelanggan = mysqli_query($koneksi,"SELECT * FROM pelanggan");
                            while ($pelanggan = mysqli_fetch_array($idpelanggan)) {
                            ?>
                            <option value="<?php echo $pelanggan['PelangganID']?>"> <?php echo $pelanggan['NamaPelanggan']?></option>
                            <?php
                            }
                            ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="">Total</label>
                                <?php
                                    $iddetail = mysqli_query($koneksi,"SELECT SUM(subtotal) AS Total FROM keranjang");
                                    $detail = mysqli_fetch_array($iddetail);
                                ?>
                                <input type="number" name="TotalHarga" class="form-control" value="<?php echo $detail['Total'] ?>">

                                <!-- <label for="">Bayar</label>
                                <?php
                                    $iddetail = mysqli_query($koneksi,"SELECT SUM(subtotal) AS Total FROM keranjang");
                                    $detail = mysqli_fetch_array($iddetail);
                                ?>
                                <input type="number" name="TotalHarga" class="form-control" value="<?php echo $detail['Total'] ?>">

                                <label for="">Kembali</label>
                                <?php
                                    $iddetail = mysqli_query($koneksi,"SELECT SUM(subtotal) AS Total FROM keranjang");
                                    $detail = mysqli_fetch_array($iddetail);
                                ?>
                                <input type="number" name="TotalHarga" class="form-control" value="<?php echo $detail['Total'] ?>">

                                 -->
                                 <br>
                                <button type="submit" id="byr" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
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
            <form action="proses_transaksi.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">produk</label>
                        <select name="ProdukID" class="form-control" required="" onchange="changeValue(this.value)">
                            <option value="" selected hidden>Pilih Produk</option>
                            <?php
                         $produk = mysqli_query($koneksi, "SELECT * FROM produk");
                         $jsArray = "var prdName = new Array();\n ";
                         while ($namaproduk = mysqli_fetch_array($produk) ) {
                           echo '<option value = "' . $namaproduk['ProdukID'] . '">' . $namaproduk
                              ['NamaProduk'] .
                           '</option>';
                         

                           $jsArray .= "prdName['" . $namaproduk['ProdukID'] . "'] = {Stok: '" .addslashes
                           ($namaproduk['Stok']) . "'};\n ";
                         }

                     ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Stok</label>
                        <input type="number" name="Stok" id="Stok" class="form-control" onkeyup="sum()" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="">qty</label>
                        <input type="number" name="JumlahProduk" class="form-control">
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
        <script>
            document.getElementById("byr").addEventListener("click", struk );

            function struk() {
                <?php
                    $query = mysqli_query($koneksi,"SELECT max(penjualanID) as tokenterbesar FROM penjualan");
                    $data = mysqli_fetch_array($query);
                    $idpenjualan = $data['tokenterbesar'];
                    
                    $urutan = (int) substr($idpenjualan,4,4);
                    $urutan++;
                    $huruf=date("Y");
                    $idpenjualan = $huruf . sprintf("%03s",$urutan);
                    ?>
            var notrans = <?php echo $idpenjualan ?>;
            if (document.getElementById("pelanggan").value) {
              
              window.open('../struk.php?idpenjualan='+notrans,'_blank');
            } else {
              
            }
            }
        </script>
      


   
        <script type="text/javascript">
       <?php echo $jsArray; ?>
       function changeValue(id) {
         document.getElementById('Stok').value = prdName[id].Stok;
       };
       </script>
<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
