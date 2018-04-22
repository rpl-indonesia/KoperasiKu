 <?php
  require 'lib/init.php';
  $run = new lib\controller\controller;
  if (isset($_GET['logout'])) {
    $run->setSes('logout', 'Berhasil Logout');
    $run->logout('petugas', asset('login/'));
  }
  
  $user = $run->getSessionLogin('petugas',
    [
      'primary' => 'username',
      'ses'     => 'petugas'
    ]
  );
  if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
  }else{
    $menu = '';
  }
  $act['dashboard']         = '';
  $act['anggota']         = '';
  $act['simpanan']          = '';
  $act['pinjaman']          = '';
  $act['kategori-pinjaman'] = '';
  $act['laporan']           = '';

  $breadcrumb['dashboard']          = "";
  $breadcrumb['anggota']           = "";
  $breadcrumb['simpanan']           = "";
  $breadcrumb['pinjaman']           = "";
  $breadcrumb['kategori-pinjaman']  = "";
  $breadcrumb['laporan']            = "";

  switch ($menu) {
    case 'dashboard':
      $inc = 'inc/petugas/dashboard.php';
      $act['dashboard'] = 'active';
      $breadcrumb['dashboard'] = "Dashboard";
    break;
    case 'anggota':
      $inc = 'inc/petugas/anggota.php';
      $act['anggota'] = 'active';
      $breadcrumb['anggota'] = "Dashboard";
    break;
    case 'simpanan':
      $inc = 'inc/petugas/simpanan.php';
      $act['simpanan'] = 'active';
      $breadcrumb['simpanan'] = "Simpanan";
    break;
    case 'pinjaman':
      $inc = 'inc/petugas/pinjaman.php';
      $act['pinjaman'] = 'active';
      $breadcrumb['pinjaman'] = "Pinjaman";
    break;
    case 'kategori-pinjaman':
      $inc = 'inc/petugas/kategori-pinjaman.php';
      $act['pinjaman'] = 'active';
      $breadcrumb['kategori-pinjaman'] = "Kategori Pinjaman";
    break;
    case 'laporan':
      $inc = 'inc/petugas/laporan.php';
      $act['laporan'] = 'active';
      $breadcrumb['laporan']   = "Laporan";
    break;
    default:
      $inc = 'inc/petugas/dashboard.php';
      $act['Dashboard'] = 'active';
      $breadcrumb['dashboard'] = "Dashboard";
    break;
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KoperasiKu</title>
    <link rel="shortcut icon" href="<?=asset('assets/img/Logo/LogoKoperasi_Transparent.jpg')?>">
	<link href="<?=asset('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
	<link href="<?=asset('assets/css/font-awesome.min.css')?>" type="text/css" rel="stylesheet">
	<link href="<?=asset('assets/css/datepicker3.css')?>" type="text/css" rel="stylesheet">
	<link href="<?=asset('assets/css/styles.css')?>" type="text/css" rel="stylesheet">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
	<body>
		<?php 
			include('header.php');
		?>

  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
      <div class="profile-sidebar">
        <div class="profile-userpic">
          <img src="<?=asset('assets/img/developer/aku.jpg')?>" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
          <div class="profile-usertitle-name"><?=$user->nama?></div>
          <div class="profile-usertitle-status"><span class="indicator label-success"></span>Petugas</div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="divider"></div>
      <form role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
      </form>
      <ul class="nav menu">
        <li class="<?=$act['dashboard']?>">
          <a href="?menu=dashboard"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li class="<?=$act['anggota']?>">
          <a href="?menu=anggota"><em class="fa fa-users ">&nbsp;</em> Anggota</a>
        </li>
        <li class="<?=$act['simpanan']?>">
          <a href="?menu=simpanan"><em class="fa fa-money">&nbsp;</em> Simpanan</a>
        </li>
        <li class="<?=$act['pinjaman']?>">
          <a href="?menu=pinjaman"><em class="fa fa-th-list">&nbsp;</em> Pinjaman Transaksi</a>
        </li>
        <li class="<?=$act['laporan']?>">
          <a href="?menu=laporan"><em class="fa fa-bar-chart">&nbsp;</em> Laporan</a>
        </li>
        <li>
          <a href="?logout"><em class="fa fa-power-off">&nbsp;</em> Logout</a>
        </li>
      </ul>
    </div>
		
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		    <?php include $inc; ?>
		</div>

    <div class="col-sm-12">
      <p class="back-link">Copyright KoperasiKu (c) 2018 All Reserved <a href="#">HE</a></p>
    </div>
		
		<script src="<?=asset('assets/js/jquery-1.11.1.min.js')?>"></script>
		<script src="<?=asset('assets/js/bootstrap.min.js')?>"></script>
		<script src="<?=asset('assets/js/chart.min.js')?>"></script>
		<script src="<?=asset('assets/js/chart-data.js')?>"></script>
		<script src="<?=asset('assets/js/easypiechart.js')?>"></script>
		<script src="<?=asset('assets/js/easypiechart-data.js')?>"></script>
		<script src="<?=asset('assets/js/bootstrap-datepicker.js')?>"></script>
		<script src="<?=asset('assets/js/custom.js')?>"></script>
		<script>
			window.onload = function () {
				var chart1 = document.getElementById("line-chart").getContext("2d");
				window.myLine = new Chart(chart1).Line(lineChartData, {
				responsive: true,
				scaleLineColor: "rgba(0,0,0,.2)",
				scaleGridLineColor: "rgba(0,0,0,.05)",
				scaleFontColor: "#c5c7cc"
				});
			};
		</script>
	</body>
</html>