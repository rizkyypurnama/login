<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$ProdukID = $_POST['ProdukID'];
$JumlahProduk = $_POST['JumlahProduk'];

$hargaambil = mysqli_query($koneksi ,"SELECT * from produk where produkID = $ProdukID");
$d = mysqli_fetch_array($hargaambil);
$hargabarang = (int)$d['Harga'];
$subtotal = $hargabarang * (int)$JumlahProduk;

// mengambil data stok produk
$ambil_stok = mysqli_query($koneksi, "SELECT stok FROM produk WHERE produkID = $ProdukID");
$data_stok = mysqli_fetch_array($ambil_stok);

// mengecek apakah JumlahProduk cukup atau tidak
if((int)$JumlahProduk <= 0){
    // jika JumlahProduk tidak cukup, maka tampilkan alert
    echo "<script>alert('Jumlah Produk minimal 1');</script>";
    echo "<script>location.href='transaksi.php';</script>";
} else if((int)$JumlahProduk > (int)$data_stok['stok']){
    // jika stok tidak cukup, maka tampilkan alert
    echo "<script>alert('Stok kurang');</script>";
    echo "<script>location.href='transaksi.php';</script>";
} else {
    // menginput data ke database
    $cekItem = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE ProdukID = $ProdukID");
    if (mysqli_num_rows($cekItem) > 0) {
        // jika item sudah ada, maka tambahkan qty nya
        mysqli_query($koneksi, "UPDATE keranjang SET jumlahproduk = jumlahproduk + $JumlahProduk WHERE ProdukID = $ProdukID");
        
        // mengurangi stok produk
        mysqli_query($koneksi,"UPDATE produk SET stok = stok -$JumlahProduk where ProdukID = '$ProdukID'");
        
        // mengambil data keranjang terbaru
        $ambil_keranjang = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE ProdukID = $ProdukID");
        $data_keranjang = mysqli_fetch_array($ambil_keranjang);
        
        // mengambil subtotal dari keranjang terbaru
        $subtotal = $data_keranjang['subtotal'] + ($hargabarang * $JumlahProduk);
        
        // mengupdate subtotal pada keranjang
        mysqli_query($koneksi, "UPDATE keranjang SET subtotal = $subtotal WHERE ProdukID = $ProdukID");
    } else {
        // jika item belum ada, maka tambahkan baru
        mysqli_query($koneksi,"insert into keranjang values('','$ProdukID','$JumlahProduk','$subtotal')");
        
        // mengurangi stok produk
        mysqli_query($koneksi,"UPDATE produk SET stok = stok -$JumlahProduk where ProdukID = '$ProdukID'");
    }
    // mengalihkan halaman kembali ke index.php
    echo "<script>location.href='transaksi.php';</script>";
}
?>