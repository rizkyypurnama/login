<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$id_user = $_POST['id_user'];
$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$level = $_POST['level'];
// update data ke database
mysqli_query($koneksi,"update user set nama_petugas='$nama_petugas', username='$username', level='$level'
 where id_user='$id_user'");
 
// mengalihkan halaman kembali ke index.php
header("location:data_pengguna.php?pesan=update");
 
?>