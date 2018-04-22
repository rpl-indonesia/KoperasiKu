<?php
  $dashboard = "?menu=dashboard";
  $red = "?menu=simpanan";
  if (isset($_GET['edit'])) {
    $edit = $run->ambil('simpanan', ['where' => 'md5(id_simpanan)', 'id' => antiInject($_GET['id'])]);
  }
  if (!isset($_GET['edit'])) {
    $anukeren = $run->ambilSatu('simpanan order by id_simpanan desc');
    if (empty($anukeren)) {
      $angka = 0;
    }else{
      $angka = substr($anukeren->id_simpanan, 2, 3);
    }
    $angka++;
    $char = 'SM';
    $kode = $char.str_pad($angka, 3, "0", STR_PAD_LEFT);
  }else{
    $kode = $edit->id_simpanan;
  }
  if (isset($_POST['simpan'])) {
    if (!empty($_POST['nama_simpanan'])  &&
        !empty($_POST['anggota'])        &&
        !empty($_POST['besar_simpanan']) &&
        !empty($_POST['keterangan'])) {
      $field = array(
        'id_simpanan'      => $kode,
        'nama_simpanan'    => antiInject($_POST['nama_simpanan']),
        'id_anggota'       => antiInject($_POST['anggota']),
        'tanggal_simpanan' => date('Y-m-d'),
        'besar_simpanan'   => antiInject($_POST['besar_simpanan']),
        'keterangan'       => antiInject($_POST['keterangan']),
        'id_petugas'       => $user->id_petugas
      );
      if (antiInject($_POST['besar_simpanan']) <= 0) {
        $run->setSes2('alert', 'Tidak boleh kurang dari 0');
        header('location: '.$red);
      }else{
        if ($run->simpan('simpanan', $field)) {
          $run->setSes2('alert', 'Berhasil di simpan');
          header('location: '.$red);
        }else{
          $run->setSes2('alert', 'Gagal di simpan');
          header('location: '.$red);
        }
      }
    }else{
      $run->setSes2('alert', 'Data Tidak Boleh Kosong');
      header('location: '.$red);
    }
  }
  if (isset($_GET['hapus'])) {
    $id = antiInject($_GET['id']);
    if ($run->hapus('simpanan', ['where' => 'md5(id_simpanan)', 'id' => $id])) {
      $run->setSes2('alert', 'Berhasil di Hapus');
      header('location: '.$red);
    }else{
      $run->setSes2('alert', 'Gagal di Hapus');
      header('location: '.$red);
    }
  }
?>

<div class="row">
  <ol class="breadcrumb">
    <li><a href="?menu=dashboard">
      <em class="fa fa-home"></em>
    </a></li>
    <li class="active">Simpanan</li>
  </ol>
</div>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Kelola Simpanan</h1>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Form Simpanan
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
              <label>Kode Simpanan</label>
              <input class="form-control" placeholder="Contoh (SM0001)" name="idanggota" id="idanggota" class="input active" readonly value="<?=$kode?>">
            </div>
            <div class="form-group">
              <label>Nama Simpanan</label>
              <input class="form-control" type="text" name="nama_simpanan" id="nama_simpanan" required autocomplete="off" value="<?php if(isset($_GET['edit'])){echo $edit->nama;} ?>" placeholder="Contoh : Simpanan Tetap" maxlength="30">
            </div>
            <div class="form-group">
              <label>Pilih Anggota</label>
                <select class="form-control" name="anggota" id="anggota">
                  <option disabled selected>- Pilih -</option>
                  <?php foreach($run->showData('anggota order by nama asc') as $r): ?>
                  <option value="<?=$r->id_anggota?>"><?='('.strtoupper($r->id_anggota).') - ' . $r->nama?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
              <label>Besar Simpanan</label>
              <input class="form-control" type="number" name="besar_simpanan" id="besar_simpanan" required autocomplete="off" value="<?php if(isset($_GET['edit'])){echo $edit->nama;} ?>" placeholder="Contoh : Rp. 100.000" maxlength="30">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" id="keterangan" rows="3" class="input" required><?php if(isset($_GET['edit'])){echo $edit->alamat;} ?></textarea>
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
