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
    <title>Halaman Admin</title>
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
                    </li>
                    <br>
                    <div class="nav">
                            <div class="sb-sidenav-menu-heading">MASTER DATA</div>
                            <a class="nav-link" href="data_pengguna.php">
                                <br>
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                PETUGAS
                            </a>
                            <a class="nav-link" href="data_barang.php">
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
                            <br>
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


            <!-- isi -->
            <div class="container" style="width: 115%;">
                <div class="content">
                    <div class="card mt-5">

                        <?php
                        include("../koneksi.php");
                        // Handle date filter
                        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                        // Query untuk mendapatkan data dari view_laporan
                        $query = "SELECT DetailID, PelangganID, NamaPelanggan, NamaProduk, Harga, JumlahProduk, TotalHarga, TanggalPenjualan FROM view_laporan";

                        // Add date filter to the query
                        if (!empty($startDate) && !empty($endDate)) {
                            $query .= " WHERE TanggalPenjualan BETWEEN '$startDate' AND '$endDate'";
                        }

                        $result = $koneksi->query($query);

                        $result = $koneksi->query($query);
                        // Initialize total revenue variable
                        $totalRevenue = 0;
                        $totalKeseluruhan = 0;

                        // Periksa apakah query berhasil dijalankan
                        if ($result) {
                        ?>
                            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
                                <!-- ... (your existing navigation code) ... -->
                            </nav>

                            <div class="container-fluid py-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-3">
                                            <div class="card-header pb-0">
                                                <div class="card-header pb-0 d-flex justify-content-between">
                                                    <div class="card-title"><i class="fa fa-table me-2"></i> Data Laporan</div>
                                                    <div>
                                                        <button class="btn btn-primary" i class="ni ni-chart-bar-32" onclick="printAllTransactions()">Print All</button>
                                                    </div>
                                                </div>


                                                <!-- Date Filter Form -->

                                                <form method="GET" action="">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-3 pr-0">
                                                            <label class="mb-1">Dari Tanggal:</label>
                                                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $startDate; ?>">
                                                        </div>
                                                        <div class="col-6 col-lg-3 pr-0">
                                                            <label class="mb-1">Sampai Tanggal:</label>
                                                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $endDate; ?>">
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">Filter</button>
                                                            <a href="?reset=true" class="btn btn-danger">Reset</a>
                                                        </div>
                                                    </div>
                                                </form>

                                                <div class="card-body px-0 pt-0 pb-">
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                    ?>
                                                        <div class="table-responsive p-0">
                                                            <br>
                                                            <table class="table align-items-center mb-0" id="transaction-table" style="width: 100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No Trans</th>
                                                                        <th>Id Pelanggan</th>
                                                                        <th>Nama Pelanggan</th>
                                                                        <th>Nama Produk</th>
                                                                        <th>Harga </th>
                                                                        <th>Total Harga</th>
                                                                        <th>Tanggal </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $counter = 1;
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        $nota = $row['DetailID'];
                                                                    ?>
                                                                        <tr>
                                                                            <td>TRSK <?php echo $counter; ?></td>
                                                                            <td><?php echo $row['PelangganID']; ?></td>
                                                                            <td><?php echo $row['NamaPelanggan']; ?></td>
                                                                            <td><?php echo $row['NamaProduk']; ?></td>
                                                                            <td><?php echo $row['Harga']; ?></td>
                                                                            <td><?php echo $row['TotalHarga']; ?></td>
                                                                            <td><?php echo $row['TanggalPenjualan']; ?></td>
                                                                        </tr>
                                                                    <?php
                                                                        $totalRevenue += $row['TotalHarga']; // Menambahkan total penjualan pada setiap iterasi
                                                                        $counter++;
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td><strong>Total Keseluruhan</strong></td>
                                                                        <td colspan="5"></td>
                                                                        <td><?php echo 'Rp ' . number_format($totalRevenue, 0, ',', '.'); ?></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    <?php
                                                    } else {
                                                        echo "Tidak ada data transaksi.";
                                                        // Optionally reset the date filter
                                                        if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
                                                            $selectedDate = '';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
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

                <?php
                            // Bebaskan hasil query
                            $result->free_result();
                        } else {
                            echo "Query error: " . $koneksi->error;
                        }

                        // Tutup koneksi
                        $koneksi->close();
                ?>
                <script>
                    function printAllTransactions() {
                        // Create a new window for printing
                        var printWindow = window.open('', '_blank');
                        printWindow.document.write('<html><head><title>Print Data</title></head><body>');
                        printWindow.document.write('<style>body { font-family: Times New Roman, sans-serif; text-align: center; }');
                        printWindow.document.write('@media print { @page { size: landscape; } }'); // Set orientasi kertas ke landscape
                        printWindow.document.write('h1 { font-size: 30px; }'); // Ubah ukuran font judul
                        printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 20px; }');
                        printWindow.document.write('table, th, td { border: 1px solid #ddd; }');
                        printWindow.document.write('th, td { padding: 13px; text-align: center; background-color: #f2f2f2; }');
                        printWindow.document.write('th { background-color: #333; color: #fff; }</style></head><body>');
                        printWindow.document.write('<h1>DATA LAPORAN PENJUALAN</h1>'); // Judul
                        printWindow.document.write('<table>');
                        

                        // Body content
                        printWindow.document.write('<tbody>');
                        var originalTable = document.querySelector('#transaction-table');
                        for (var i = 0; i < originalTable.rows.length; i++) {
                            printWindow.document.write('<tr>');
                            for (var j = 0; j < originalTable.rows[i].cells.length - 1; j++) {
                                printWindow.document.write('<td>' + originalTable.rows[i].cells[j].innerHTML + '</td>');
                            }
                            printWindow.document.write('</tr>');
                        }
                        printWindow.document.write('</tbody>');

                        printWindow.document.write('</table>');
                        printWindow.document.write('</body></html>');
                        printWindow.document.close();
                        printWindow.print();
                    }
                </script>
<script src="../js/bootstrap.bundle.min.js"></script>
            </body>

</html>