<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$ProdukID = $_POST['ProdukID'];

// mengecek apakah data sudah ada di tabel detailpenjualan
$ambil_detailpenjualan = mysqli_query($koneksi, "SELECT * FROM detailpenjualan WHERE ProdukID = $ProdukID");
$data_detailpenjualan = mysqli_fetch_array($ambil_detailpenjualan);

if (mysqli_num_rows($ambil_detailpenjualan) > 0) {

   
    echo "<script>alert('Data produk tidak dapat dihapus, karena sudah terdaftar di tabel detailpenjualan');</script>";
    echo "<script>location.href='data_barang.php';</script>";
} else {
    
    mysqli_query($koneksi,"delete from produk where ProdukID='$ProdukID'");

   
    header("location:data_barang.php?pesan=hapus");
}
?>