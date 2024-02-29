<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url
$id_user = $_POST['id_user'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"DELETE from user where id_user='$id_user'");
 
// mengalihkan halaman kembali ke index.php
header("location:data_pengguna.php?pesan=hapus");
 
?>