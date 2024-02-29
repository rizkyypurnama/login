<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang dikirim dari form
$keranjangid = $_POST['keranjangid'];

// mengambil data keranjang berdasarkan keranjangid
$ambil_keranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE keranjangid = '$keranjangid'");
$data_keranjang = mysqli_fetch_array($ambil_keranjang);

// mengambil data produk berdasarkan produkid
$ambil_produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE produkid = '$data_keranjang[produkid]'");
$data_produk = mysqli_fetch_array($ambil_produk);

// mengambil stok saat ini dari tabel produk
$stok_saat_ini = $data_produk['Stok'];

// mengambil qty dari keranjang
$qty_keranjang = $data_keranjang['jumlahproduk'];

// menambahkan qty ke dalam stok
$stok_baru = $stok_saat_ini + $qty_keranjang;

// mengupdate stok pada tabel produk
mysqli_query($koneksi, "UPDATE produk SET stok = '$stok_baru' WHERE produkid = '$data_keranjang[produkid]'");

// menghapus data keranjang
mysqli_query($koneksi, "DELETE FROM keranjang WHERE keranjangid = '$keranjangid'");

// mengalihkan halaman ke detail transaksi
header("location:transaksi.php");
?>