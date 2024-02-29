<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$pelangganID = $_POST['PelangganID'];

// mengecek apakah data sudah ada di tabel detailpenjualan
$ambil_pelanggan = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE PelangganID = $pelangganID");
$data_pelangan = mysqli_fetch_array($ambil_pelanggan);

if (mysqli_num_rows($ambil_pelanggan) > 0) {

    echo "<script>alert('Data pelanggan tidak dapat dihapus, karena sudah terdaftar di tabel detailpenjualan');</script>";
    echo "<script>location.href='pelanggan.php';</script>";
} else {
    
    mysqli_query($koneksi,"delete from pelanggan where PelangganID='$pelangganID'");

    header("location:pelanggan.php?pesan=hapus");
}
?>