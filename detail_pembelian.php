<?php
session_start();
// Cek apakah sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
<?php
    // Cek level user dan tampilkan konten yang sesuai
    if ($_SESSION['Level'] == "Kasir") {
        // Tampilan untuk Kasir
        ?>
            <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down   d-md-none">
							<form action="#">
								<input type="text" class="form-control" placeholder="Search">
							</form>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge gradient-1 badge-pill badge-primary">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>  
                                    
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/2.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/3.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/4.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2 badge-primary">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="javascript:void()">English</a></li>
                                        <li><a href="javascript:void()">Dutch</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/user/1.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="email-inbox.html"><i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill badge-primary">3</div></a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        <li><a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a class="" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-house"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Barang</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-box"></i><span class="nav-text">Barang</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="barang.php">Barang</a></li>
                            <li><a href="rak.php">Rak</a></li>
                            <li><a href="supplier.php">Suplier</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Transaksi</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-cart-shopping"></i><span class="nav-text">Transaksi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="pembelian_barang.php">Pembelian</a></li>
                            <li><a href="pengeluaran.php">Pengeluaran</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">User</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa-solid fa-user"></i><span class="nav-text">User</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="member.php">Member</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="" href="kasir.php" aria-expanded="false">
                        <i class="fa-solid fa-cash-register"></i><span class="nav-text">Kasir</span>
                        </a>
                    </li>
                    <li>
                        <a class="" href="kas.php" aria-expanded="false">
                        <i class="fa-solid fa-money-bill"></i><span class="nav-text">Kas</span>
                        </a>
                    </li>
                    <li>
                        <a class="" href="shift.php" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Shift</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->
<?php
include 'koneksi.php';

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    header('Location: pembelian.php');
    exit();
}

$id_pembelian = $_GET['id'];

// Query untuk mengambil data pembelian dan supplier
$query_pembelian = "SELECT pembelian.*, supplier.Nama_Supplier, supplier.Alamat, supplier.Telepon 
                    FROM pembelian
                    LEFT JOIN supplier ON pembelian.Id_Supplier = supplier.Id_Supplier
                    WHERE pembelian.Id_Pembelian = '$id_pembelian'";
$result_pembelian = mysqli_query($koneksi, $query_pembelian);
$pembelian = mysqli_fetch_assoc($result_pembelian);

// Query untuk mengambil detail barang yang dibeli
$query_detail = "SELECT detail_pembelian.*, barang.Nama_Barang 
                 FROM detail_pembelian
                 LEFT JOIN barang ON detail_pembelian.Id_Barang = barang.Id_Barang
                 WHERE detail_pembelian.Id_Pembelian = '$id_pembelian'";
$result_detail = mysqli_query($koneksi, $query_detail);
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>Detail Pembelian</h4>
                            <a href="pembelian_barang.php" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <!-- Informasi Pembelian -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Informasi Pembelian</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="30%">ID Pembelian</td>
                                        <td>: <?php echo $pembelian['Id_Pembelian']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembelian</td>
                                        <td>: <?php echo date('d/m/Y', strtotime($pembelian['Tgl_Pembelian'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>: <span class="badge badge-<?php echo ($pembelian['Status_Pembelian'] == 'Lunas') ? 'success' : 'warning'; ?>">
                                            <?php echo $pembelian['Status_Pembelian']; ?>
                                        </span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Informasi Supplier</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="30%">Nama Supplier</td>
                                        <td>: <?php echo $pembelian['Nama_Supplier']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?php echo $pembelian['Alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td>: <?php echo $pembelian['Telepon']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Detail Barang -->
                        <h5>Detail Barang</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    while($detail = mysqli_fetch_array($result_detail)) {
                                        $subtotal = $detail['Jumlah'] * $detail['Harga_Satuan'];
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $detail['Nama_Barang']; ?></td>
                                        <td><?php echo $detail['Jumlah']; ?></td>
                                        <td>Rp <?php echo number_format($detail['Harga_Satuan'], 0, ',', '.'); ?></td>
                                        <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">Total Harga:</th>
                                        <th>Rp <?php echo number_format($pembelian['Total_Harga'], 0, ',', '.'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="https://kit.fontawesome.com/1cf6ec8ecf.js" crossorigin="anonymous"></script>

        <?php
    } 
    else if ($_SESSION['Level'] == "Member") {
        echo "<script>alert('ANDA TIDAK PUNYA AKSES!!!');</script>";
        ?>
        

        <?php
    }
    ?>
</body>

</html>