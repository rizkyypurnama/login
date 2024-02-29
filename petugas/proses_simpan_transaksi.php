<?php 
// koneksi database
include '../koneksi.php';

//kodeauto
$query = mysqli_query($koneksi,"SELECT max(penjualanID) as tokenterbesar FROM penjualan");
$data = mysqli_fetch_array($query);
$idpenjualan = $data['tokenterbesar'];

$urutan = (int) substr($idpenjualan,4,4);
$urutan++;
$huruf=date("Y");
$idpenjualan = $huruf . sprintf("%03s",$urutan);

// menangkap data yang di kirim dari form
$PelangganID = $_POST['PelangganID'];
$TanggalPenjualan = date("Y-m-d");
$TotalHarga = $_POST['TotalHarga'];
$ambil_produk = mysqli_query($koneksi,"SELECT * FROM keranjang");
$no = 1;
mysqli_query($koneksi,"insert into penjualan values('$idpenjualan','$TanggalPenjualan','$TotalHarga','$PelangganID')");
while ($produk = mysqli_fetch_array($ambil_produk)){
    $keranjangid = $produk['keranjangid'];
    $produkid = $produk['produkid'];
    $jumlahproduk = $produk['jumlahproduk'];
    $subtotal = $produk['subtotal'];
    mysqli_query($koneksi,"insert into detailpenjualan values('', '$idpenjualan','$produkid','$jumlahproduk','$subtotal')");
}
mysqli_query($koneksi,"TRUNCATE TABLE keranjang");

 
// menginput data ke database
// menghapus keranjang
// mengalihkan halaman kembali ke index.php
header("location:transaksi.php?pesan=simpan");
 
?>