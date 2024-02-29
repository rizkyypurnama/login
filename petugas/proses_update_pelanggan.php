<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$PelangganID = $_POST['PelangganID'];
$NamaPelanggan = $_POST['NamaPelanggan'];
$Alamat = $_POST['Alamat'];
$NomorTelepon = $_POST['NomorTelepon']; 
// update data ke database
mysqli_query($koneksi,"update pelanggan set NamaPelanggan='$NamaPelanggan', Alamat='$Alamat', NomorTelepon='$NomorTelepon'
 where PelangganID='$PelangganID'");
 
// mengalihkan halaman kembali ke index.php
header("location:pelanggan.php?pesan=update");
 
?>