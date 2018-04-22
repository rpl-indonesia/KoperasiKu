 <?php

  require 'lib/init.php';
  $run = new lib\controller\controller;
  if (isset($_POST['login'])) {

    $field = array(
      'Username' => antiInject($_POST['Username']),
      'Password' => antiInject($_POST['Password'])
    );

    if (empty($_POST['Access'])) {
      $error = 'Mohon untuk memilih Akses.';
    }else if ($_POST['Access'] == 'petugas') {
      $ses = array(
        'ses'     => 'petugas',
        'primary' => antiInject($_POST['Username']),
      );
      if ($run->login('petugas', $field, $ses)) {
        $run->setSes('success', 'Berhasil login');
        echo "<script>document.location.href='".asset('petugas/')."'</script>";
      }else{
        $error = 'Username Atau Password Salah';
      }
    }else if($_POST['Access'] == 'anggota'){
      $ses = array(
        'ses'     => 'anggota',
        'primary' => antiInject($_POST['Username']),
      );
      
      if ($run->login('anggota', $field, $ses)) {
        echo "<script>document.location.href='".asset('anggota/')."'</script>";
      }else{
        $error = 'Username Atau Password Salah';
      }
    }else{
      $error = 'Akses Tidak Ada';
    }

  }

  if (isset($_SESSION[sha1('anggota')])) {
        echo "<script>document.location.href='".asset('anggota/')."'</script>";
  }else if(isset($_SESSION[sha1('petugas')])){
        echo "<script>document.location.href='".asset('petugas/')."'</script>";
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
    <!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
    <!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
    <!--[if IE 9]> <html class="no-js ie9 oldie" lang="en"> <![endif]-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koperasi - Login</title>
    <link href='http://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,800' rel='stylesheet' type='text/css' />
    <link href="<?=asset('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css"> 
    <link href="<?=asset('assets/css/styles-login.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=asset('assets/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="<?=asset('assets/img/Logo/LogoKoperasi_Transparent.jpg')?>">

</head>
<body style="background-color: grey;">
    <br><br>
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
            <div id="banner">
                <h1><strong>KoperasiKu</strong> Sejahtera</h1>
                <h5><strong>UJI KOMPETENSI</strong></h5>
            </div>
        </div>
        <br><br><br><br><br><br>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="registrationform">
            <form method="post" class="form-horizontal">
                <fieldset>
                    <legend>Login<i class="fa fa-pencil pull-right"></i></legend>
                    <div class="form-group">
                        <label for="Username" class="col-lg-2 control-label">
                            Username</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="Username" placeholder="Username" name="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="Password" placeholder="Password" name="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Access" class="col-lg-2 control-label">Akses</label>
                        <div class="col-lg-10">
                            <select class="form-control" name="Access" id="Access">
                                <option disabled selected>Hak Akses</option>
                                <option value="petugas">Petugas</option>
                                <option value="anggota">Anggota</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary" name="login">Log In</button>
                            <button type="reset" class="btn btn-warning" name="cancel">Cancel</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </div>

    <?php if (isset($error)) { ?>
      <div class="dialog" id="error"><?=$error?> </div>
      <script>
        setTimeout(function(){
          document.getElementById('error').classList.add('remove');
        }, 5000);
      </script>
      <?php } if (!empty($run->getSes('logout'))) { ?>
      <div class="dialog" id="logout"><?=$run->getSes('logout')?></div>
      <script>
        setTimeout(function(){
          document.getElementById('logout').classList.add('remove');
        }, 5000);
      </script>
    <?php $run->unsetSes('logout');} ?>

    <script src="<?=asset('assets/js/jquery.js')?>" type="text/javascript"></script>
    <script src="<?=asset('assets/js/bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="<?=asset('assets/js/jquery.backstretch.js')?>" type="text/javascript"></script>
    <script type="text/javascript">
        'use strict';
        $.backstretch(
            [
                "assets/img/44.jpg",
                "assets/img/colorful.jpg",
                "assets/img/34.jpg",
                "assets/img/images.jpg"
            ],
            {
                duration: 4500,
                fade: 1500
            }
        );
    </script>
</body>
</html>