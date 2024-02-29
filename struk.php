<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Saya</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 300px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            text-align: left;
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <h1>Kasir Saya</h1>
        <center>JL.RH Abdul Halim NO17</p></center>
        <p>--------------------------------------------------------</p>
        <table>
            <tr>
                <th>Item</th>
                <th>qty</th>
                <th>subtotal</th>
            </tr>
            <?php 
                include 'koneksi.php';
                $no = 1;
                $penjualanID = $_GET['idpenjualan'];
                $data = mysqli_query($koneksi, "SELECT * FROM penjualan INNER JOIN detailpenjualan ON penjualan.PenjualanID = detailpenjualan.PenjualanID INNER JOIN produk ON detailpenjualan.ProdukID = produk.ProdukID INNER JOIN pelanggan ON penjualan.PelangganID = pelanggan.PelangganID WHERE penjualan.penjualanID =".$penjualanID);
                while($d = mysqli_fetch_array($data)){
                ?>
                    <tr>

                        <td><?php echo $d['NamaProduk'] ?></td>
                        <td><?php echo $d['JumlahProduk'] ?></td>
                        <td><?php echo $d['Subtotal'] ?></td>
                    </tr>
            <?php }
            ?>
        </table>
        <p>--------------------------------------------------------</p>
        <br>
        <div class="total">
            <?php
            $data2 = mysqli_query($koneksi, "SELECT * FROM penjualan INNER JOIN pelanggan ON pelanggan.pelangganID = penjualan.PelangganID WHERE penjualan.penjualanID =".$penjualanID);
            $total = mysqli_fetch_array($data2);
            ?>
            Total: Rp <?php echo $total['TotalHarga'] ?><br>
            Nama Pelanggan: <?php echo $total['NamaPelanggan'] ?><br>
            Tanggal: <?php echo $total['TanggalPenjualan'] ?>
        </div>
        <br>
    </div>
</body>
</html>
