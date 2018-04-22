<?php

  $dashboard = "?menu=dashboard";
  $red = "?menu=anggota";
  $belum_kawin = '';
  $kawin = '';
  $l = '';
  $p = '';

  $Session = $run->getSessionLogin('petugas',
    [
      'primary' => 'username',
      'ses'     => 'petugas'
    ]
  );

  if (isset($_POST['refresh'])) {
    echo "<script>document.location.href='".$red."'</script>";
  }

  if (isset($_POST['reset'])) {
        $_POST['nama']           = "";
        $_POST['alamat']         = "";
        $_POST['tempat_lahir']   = "";
        $_POST['tanggal_lahir']  = "";
        $_POST['jk']             = "";
        $_POST['status']         = "";
        $_POST['telepon']        = "";
        $_POST['username']       = "";
  }

  if (isset($_GET['edit'])) {
    $edit = $run->ambil('anggota', ['where' => 'md5(id_anggota)', 'id' => antiInject($_GET['id'])]);
    if ($edit->status == 'Kawin') {
      $kawin = 'checked';
    }else{
      $belum_kawin = 'checked';
    }
  }

  if (isset($_GET['edit'])) {
    $edit = $run->ambil('anggota', ['where' => 'md5(id_anggota)', 'id' => antiInject($_GET['id'])]);
    if ($edit->jk == 'L') {
      $l = 'checked';
    }else{
      $p = 'checked';
    }
  }

  if (!isset($_GET['edit'])) {
    $anukeren = $run->ambilSatu('anggota order by id_anggota desc');
    if (empty($anukeren)) {
      $angka = 0;
    }else{
      $angka = substr($anukeren->id_anggota, 2, 3);
    }
    $angka++;
    $char = 'KD';
    $kode = $char.str_pad($angka, 3, "0", STR_PAD_LEFT);
  }else{
    $kode = $edit->id_anggota;
  }

  if (isset($_POST['insert'])) {
    if (!empty($_POST['nama'])      ||
        !empty($_POST['alamat'])    ||
        !empty($_POST['tempat_lahir']) ||
        !empty($_POST['tanggal_lahir']) ||
        !empty($_POST['jk'])        ||
        !empty($_POST['status'])    ||
        !empty($_POST['telepon']    ||
        !empty($_POST['username']))) {
      $field = array(
        'id_anggota'    => $kode,
        'nama'          => antiInject($_POST['nama']),
        'alamat'        => antiInject($_POST['alamat']),
        'tempat_lahir'  => antiInject($_POST['tempat_lahir']),
        'tanggal_lahir' => antiInject($_POST['tanggal_lahir']),
        'jk'            => antiInject($_POST['jk']),
        'status '       => antiInject($_POST['status']),
        'telepon '      => antiInject($_POST['telepon']),
        'saldo'         => 0,
        'keterangan'    => 'Tidak Aktif',
        'username'      => antiInject($_POST['username']),
        'password'      => '123',
        'flag'          => '1',
        'createdby'     => $Session->username,
        'createddate'   => date('Y-m-d H:i:s')
      );
      if ($run->validationCheckData("anggota where username='".antiInject($_POST['username'])."'") == 0) {
        if ($run->Insert('anggota', $field)) {
          $run->setSes2('alert', 'Berhasil di Simpan');
          echo "<script>document.location.href='".$red."'</script>";
        }else{
          $run->setSes2('alert', 'Gagal menyimpan data');
          echo "<script>document.location.href='".$red."'</script>";
        }
      }else{
        $run->setSes2('alert', 'Username sudah ada, mohon untuk memasukan username lain!');
        echo "<script>document.location.href='".$red."'</script>";
      }
      echo $run->validationCheckData("anggota where username='".antiInject($_POST['username'])."'");
    }else{
      $run->setSes2('alert', 'Data Tidak Boleh Kosong');
      echo "<script>document.location.href='".$red."'</script>";
    }
  }

  if (isset($_POST['update'])) {
    if (!empty($_POST['nama'])      ||
        !empty($_POST['alamat'])    ||
        !empty($_POST['tempat_lahir']) ||
        !empty($_POST['tanggal_lahir']) ||
        !empty($_POST['jk'])        ||
        !empty($_POST['status'])    ||
        !empty($_POST['telepon']    ||
        !empty($_POST['username']))) {
      $field = array(
        'nama'          => antiInject($_POST['nama']),
        'alamat'        => antiInject($_POST['alamat']),
        'tempat_lahir'  => antiInject($_POST['tempat_lahir']),
        'tanggal_lahir' => antiInject($_POST['tanggal_lahir']),
        'jk'            => antiInject($_POST['jk']),
        'status '       => antiInject($_POST['status']),
        'telepon '      => antiInject($_POST['telepon']),
        'updatedby'     => $Session->username,
        'updateddate'   => date('Y-m-d H:i:s')


      );
      $id = antiInject($_GET['id']);
      if ($run->update('anggota', $field, ['where' => 'md5(id_anggota)', 'id' => $id])) {
        $run->setSes2('alert', 'Berhasil di edit');
        echo "<script>document.location.href='".$red."'</script>";
      }else{
        $run->setSes2('alert', 'Gagal di edit');
        echo "<script>document.location.href='.$red.'&edit&id='.$id.'</script>";
      }
    }else{
      $run->setSes2('alert', 'Data Tidak Boleh Kosong');
      echo "<script>document.location.href='.$red.'&edit&id='.$id.'</script>";
    }
  }

  if (isset($_GET['hapus'])) {
    $id = antiInject($_GET['id']);
    $field = array(
      'flag' => 0
    );
    if ($run->update('anggota', $field, ['where' => 'md5(id_anggota)', 'id' => $id])) {
      $run->setSes2('alert', 'Berhasil di hapus');
      echo "<script>document.location.href='".$red."'</script>";
    }else{
      $run->setSes2('alert', 'Gagal di hapus');
      echo "<script>document.location.href='".$red."'</script>";
    }
  }

  if (isset($_POST['reset_password'])) {
      $field = array(
        'password'      => '123'
      );
      $id = antiInject($_GET['id']);
      if ($run->update('anggota', $field, ['where' => 'md5(id_anggota)', 'id' => $id])) {
        $run->setSes2('alert', 'Berhasil reset password');
        echo "<script>document.location.href='".$red."'</script>";
      }else{
        $run->setSes2('alert', 'Gagal untuk me-reset password');
        echo "<script>document.location.href='.$red.'&edit&id='.$id.'</script>";
      }
  }

?>

<div class="row">
  <ol class="breadcrumb">
    <li><a href="?menu=dashboard">
      <em class="fa fa-home"></em>
    </a></li>
    <li class="active">Anggota</li>
  </ol>
</div>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Kelola Anggota</h1>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Form Anggota
        <a href="<?=$dashboard?>">
        <span class="pull-right panel-toggle panel-button-tab-left">
          <em class="fa fa-arrow-circle-left"></em>
        </span>
        </a>
        <span class="pull-right clickable panel-toggle panel-button-tab-left">
          <em class="fa fa-toggle-up"></em>
        </span>
      </div>
      <div class="panel-body">
        <form role="form" method="post">
        <div class="col-md-6">
            <div class="form-group">
              <label>Kode Kategori</label>
              <input class="form-control" placeholder="Contoh (KD0001)" name="idanggota" id="idanggota" class="input active" readonly value="<?=$kode?>">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input class="form-control" type="textarea" name="nama" id="nama" required autocomplete="off" value="<?php if(isset($_GET['edit'])){echo $edit->nama;} ?>" placeholder="Contoh : Aldan Rizki Santosa" maxlength="30">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" rows="3" class="input" required><?php if(isset($_GET['edit'])){echo $edit->alamat;} ?></textarea>
            </div>
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" required autocomplete="off" value="<?php if(isset($_GET['edit'])){echo $edit->tempat_lahir;} ?>" placeholder="Contoh : Bogor" maxlength="30">
            </div>
            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required autocomplete="off" value="<?php if(isset($_GET['edit'])){echo $edit->tanggal_lahir;} ?>">
              <span style="font-size: 11px; color: grey;">* DD-MM-YYYY (13-05-2000)</span>
            </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
              <label>Status</label>
              <div>
                <input type="radio" name="status" value="Kawin" id="kawin" <?=$kawin?>>
                <label for="kawin">Kawin</label>
              </div>
              <div>
                <input type="radio" name="status" value="Belum Kawin" id="belum_kawin" <?=$belum_kawin?>>
                <label for="belum_kawin">Belum Kawin</label>
              </div>
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <div>
                <input type="radio" name="jk" value="L" id="laki" <?=$l?>>
                <label for="laki">Laki - laki</label>
              </div>
              <div>
                <input type="radio" name="jk" value="P" id="perempuan" <?=$p?>>
                <label for="perempuan">Perempuan</label>
              </div>
            </div>
            <div class="form-group">
              <label>Telepon</label>
              <input type="number" name="telepon" id="telepon" class="form-control" required autocomplete="off" maxlength="12" value="<?php if(isset($_GET['edit'])){echo $edit->telepon;} ?>" placeholder="Contoh : 081283368770" max-length="5">
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" id="username" class="form-control" required autocomplete="off" maxlength="16" value="<?php if(isset($_GET['edit'])){echo $edit->username;} ?>" placeholder="Contoh : aldanrizki"
              <?php
                if (isset($_GET['edit'])) {
                  echo "readonly";
                }
              ?>
              >
            </div>

            <?php if (isset($_GET['edit'])) { ?>
              <button type="submit" class="btn btn-primary" name="update">Update</button>
              <button type="submit" class="btn btn-danger" name="reset_password">Reset Password</button>
              <a href="<?=$red?>" class="btn btn-warning">Batal Edit</a>
            <?php }else{ ?>
              <button type="submit" class="btn btn-primary" name="insert">Simpan</button>
              <button type="reset" class="btn btn-warning" name="Reset">Reset</button>
            <?php } ?>

            <?php if (isset($_POST['tcari'])): ?>
              <a href="<?=$red?>" class="btn btn-default">Batal Cari</a>
            <?php endif ?>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Data Anggota
        <div class="columns btn-group pull-right" style="margin-top: -3.5px">
          <form method="post">
            <button class="btn btn-default" type="submit" name="refresh" title="Refresh">
              <i class="fa fa-refresh"></i>
            </button>
          </form>
        </div>
        <div class="pull-right search">
          <form method="post">
            <input class="form-control" type="text" placeholder="Cari" name="tcari" id="tcari" autocomplete="off" value="<?php if(isset($_POST['tcari'])){ echo $_POST['tcari'];} ?>">
          </form>
        </div>
      </div>

      <div class="panel-body btn-margins">
        <div class="col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tempat,&nbsp;Tanggal&nbsp;Lahir</th>
                <th>Jenis&nbsp;Kelamin</th>
                <th>Telepon</th>
                <th>Saldo</th>
                <th>Username</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $batas = 10;
              if (isset($_GET['halaman'])) {
                if ($_GET['halaman'] <= 0) {
                  $halaman = 1;
                }else{
                  $halaman = antiInject($_GET['halaman']);
                }
              }else{
                $halaman = 1;
              }
              $posisi = ($halaman - 1) * $batas;
              $no = $posisi + 1;
              if (isset($_POST['tcari'])) {
                $a = $run->showDataSearch('anggota', ['nama','id_anggota','alamat', 'tempat_lahir','tanggal_lahir','jk','status','telepon','keterangan','saldo','username'], antiInject($_POST['tcari']), ' and flag=1 order by id_anggota asc');
                $validationCheckData = $run->validationCheckDataSearch('anggota', ['nama','id_anggota','alamat', 'tempat_lahir','tanggal_lahir','jk','status','telepon','keterangan','saldo','username'], antiInject($_POST['tcari']), ' and flag=1 order by id_anggota asc');
              }else{
                $sql = "anggota where flag = 1 order by id_anggota asc";
                $a = $run->showData($sql);
                $validationCheckData = $run->validationCheckData($sql);
              }
              $no = 1;
              if ($validationCheckData > 0) {
                foreach ($a as $r) {
            ?>
        <tr
          <?php
            if ($r->keterangan == "Aktif") {
              echo 'class="success"';
            }else{
              echo 'class="danger"';
            }
          ?>
        >
          <td><?=$no?></td>
          <td><?=$r->nama?></td>
          <td><?=$r->alamat?></td>
          <td><?=$r->tempat_lahir?>, <?=date('d M Y', strtotime($r->tanggal_lahir))?></td>
          <td>
            <?php
              if ($r->jk == 'L') {
                echo 'Laki - laki';
              }else{
                echo 'Perempuan';
              }
            ?>
          </td>
          <td><?=$r->telepon?></td>
          <td>Rp. <?=number_format($r->saldo)?></td>
          <td><?=$r->username?></td>
          <td>
            <a href="<?=$red?>&edit&id=<?=md5($r->id_anggota)?>">
              <span class="fa fa-edit"></span>
            </a>
            <a href="<?=$red?>&hapus&id=<?=md5($r->id_anggota)?>" onclick="return confirm('Apakah anda yakin ingin menghapus data <?=$r->nama?> ?')">
                <span class="fa fa-trash"></span>
            </a>
          </td>
        </tr>
        <?php $no++; }}else{ echo '<tr> <td class="center-align" colspan="10"> No Data Found </td> </tr>'; } ?>
            </tbody>
          </table>
        </div>

        <div class="fixed-table-pagination">
          <div class="pull-left pagination-detail">
            <span class="pagination-info">Showing 1 to 10 of 21 rows</span>
            <span class="page-list">
              <span class="btn-group dropup">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="page-size">10</span>
                <span class="caret"></span>
              </button>
                <ul class="dropdown-menu" role="menu">
                  <li class="active">
                    <a href="javascript:void(0)">10</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">25</a>
                  </li>
                    <li><a href="javascript:void(0)">50</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)">100</a>
                  </li>
                </ul>
              </span> records per page</span>
            </div>
            <div class="pull-right pagination">
              <ul class="pagination">
                <li class="page-first disabled">
                  <a href="javascript:void(0)">&lt;&lt;</a>
                </li>
                <li class="page-pre disabled">
                  <a href="javascript:void(0)">&lt;</a>
                </li>
                <li class="page-number active disabled">
                  <a href="javascript:void(0)">1</a>
                </li>
                <li class="page-number">
                  <a href="javascript:void(0)">2</a>
                </li>
                <li class="page-number">
                  <a href="javascript:void(0)">3</a>
                </li>
                <li class="page-next">
                  <a href="javascript:void(0)">&gt;</a>
                </li>
                <li class="page-last">
                  <a href="javascript:void(0)">&gt;&gt;
                </a>
                </li>
              </ul>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>

<?php
  if (!empty($run->getSes2('alert'))) {
?>

<div class="dialog" id="alert"><?=$run->getSes2('alert')?></div>
<script>
  setTimeout(function(){
    document.getElementById('alert').classList.add('remove');
  }, 5000);
</script>
<?php
    $run->unsetSes2('alert');
  }
?>
