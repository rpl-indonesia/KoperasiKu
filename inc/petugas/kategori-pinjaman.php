<?php

  $red = "?menu=kategori-pinjaman";

  if (isset($_GET['edit'])) {
    $edit = $run->ambil('kategori_pinjaman', ['where' => 'md5(id_kategori_pinjaman)', 'id' => antiInject($_GET['id'])]);
  }

  if (!isset($_GET['edit'])) {
    $anukeren = $run->ambilSatu('kategori_pinjaman order by id_kategori_pinjaman desc');
    if (empty($anukeren)) {
      $angka = 0;
    }else{
      $angka = substr($anukeren->id_kategori_pinjaman, 2, 3);
    }
    $angka++;
    $char = 'KD';
    $kode = $char.str_pad($angka, 3, "0", STR_PAD_LEFT);
  }else{
    $kode = $edit->id_kategori_pinjaman;
  }

  if (isset($_POST['Insert'])) {
    if (!empty($_POST['kategori'])) {
      $field = array(
        'id_kategori_pinjaman' => $kode,
        'nama_pinjaman'        => antiInject($_POST['kategori'])
      );
      if ($run->validationCheckData("kategori_pinjaman where nama_pinjaman='".antiInject($_POST['kategori'])."'") > 0) {
        $run->setSes2('alert', 'Data Sudah ada');
        echo "<script>document.location.href='".$red."'</script>";
      }else{
        if ($run->Insert('kategori_pinjaman', $field)) {
          $run->setSes2('alert', 'Berhasil di Insert');
          echo "<script>document.location.href='".$red."'</script>";
        }else{
          $run->setSes2('alert', 'Gagal di Insert');
          echo "<script>document.location.href='".$red."'</script>";
        }
      }
    }else{
      $run->setSes2('alert', 'Data Tidak Boleh Kosong');
      echo "<script>document.location.href='".$red."'</script>";
    }
  }
  if (isset($_POST['update'])) {
    if (!empty($_POST['kategori'])) {
      $field = array(
        'nama_pinjaman' => antiInject($_POST['kategori'])
      );
      $id = antiInject($_GET['id']);
      if ($run->validationCheckData("kategori_pinjaman where nama_pinjaman='".antiInject($_POST['kategori'])."'") > 0) {
        $run->setSes2('alert', 'Data Sudah ada');
        echo "<script>document.location.href='.$red.'&edit&id='.$id.'</script>";
      }else{
        if ($run->update('kategori_pinjaman', $field, ['where' => 'md5(id_kategori_pinjaman)', 'id' => $id])) {
          $run->setSes2('alert', 'Berhasil di edit');
          echo "<script>document.location.href='".$red."'</script>";
        }else{
          $run->setSes2('alert', 'Gagal di edit');
          echo "<script>document.location.href='.$red.'&edit&id='.$id.'</script>";
        }
      }
    }else{
      $run->setSes2('alert', 'Data Tidak Boleh Kosong');
      echo "<script>document.location.href='.$red.'&edit&id='.$id.'</script>";
    }
  }
  if (isset($_GET['hapus'])) {
    $id = antiInject($_GET['id']);
    if ($run->hapus('kategori_pinjaman', ['where' => 'md5(id_kategori_pinjaman)', 'id' => $id])) {
      $run->setSes2('alert', 'Berhasil di Hapus');
      echo "<script>document.location.href='".$red."'</script>";
    }else{
      $run->setSes2('alert', 'Gagal di Hapus');
      echo "<script>document.location.href='".$red."'</script>";
    }
  }
?>

<div class="row">
  <ol class="breadcrumb">
    <li><a href="?menu=dashboard">
      <em class="fa fa-home"></em>
    </a></li>
    <li class="active">Kategori Pinjaman</li>
  </ol>
</div>

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Kategori Pinjaman</h1>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Form 
        <a href="?menu=pinjaman">
        <span class="pull-right panel-toggle panel-button-tab-left">
          <em class="fa fa-arrow-circle-left"></em>
        </span>
        </a>
        <span class="pull-right clickable panel-toggle panel-button-tab-left">
          <em class="fa fa-toggle-up"></em>
        </span>
      </div>
      <div class="panel-body">
        <div class="col-md-5">
          <form role="form" method="post">
            <div class="form-group">
              <label>Kode Kategori</label>
              <input class="form-control" placeholder="Contoh (KD0001)" name="idkategori" id="idkategori" class="input active" readonly value="<?=$kode?>">
            </div>
            <div class="form-group">
              <label>Nama Kategori</label>
              <input class="form-control" placeholder="Contoh : Pinjaman Modal " name="kategori" id="kategori" class="input" required autocomplete="off" value="<?php if(isset($_GET['edit'])){echo $edit->nama_pinjaman;} ?>">
            </div>

            <?php if (isset($_GET['edit'])) { ?>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <a href="<?=$red?>" class="btn ungu">Batal Edit</a>
            <?php }else{ ?>
            <button type="submit" class="btn btn-primary" name="Insert">Simpan</button>
            <button type="reset" class="btn btn-default" name="Reset">Reset</button>
            <?php } ?>

            <?php if (isset($_POST['tcari'])): ?>
              <a href="<?=$red?>n" class="btn ungu">Batal Cari</a>
            <?php endif ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          Table Hover
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
                <th>Kode Kategori</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if (isset($_POST['tcari'])) {
                  $a = $run->showDataSearch('kategori_pinjaman', ['nama_pinjaman','id_kategori_pinjaman'], antiInject($_POST['tcari']), ' order by id_kategori_pinjaman asc');
                  $validationCheckData = $run->validationCheckDataSearch('kategori_pinjaman', ['nama_pinjaman','id_kategori_pinjaman'], antiInject($_POST['tcari']), ' order by id_kategori_pinjaman asc');
                }else{
                  $sql = "kategori_pinjaman order by id_kategori_pinjaman asc";
                  $a = $run->showData($sql);
                  $validationCheckData = $run->validationCheckData($sql);
                }
                $no = 1;
                if ($validationCheckData > 0) {
                  foreach ($a as $r) {
              ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$r->id_kategori_pinjaman?></td>
                  <td><?=$r->nama_pinjaman?></td>
                  <td>
                    <a href="?menu=kategori-pinjaman&hapus&id=<?=md5($r->id_kategori_pinjaman)?>" onclick="return confirm('Are you sure to delete this data?')">Hapus</a>&nbsp;
                    <a href="?menu=kategori-pinjaman&edit&id=<?=md5($r->id_kategori_pinjaman)?>">Edit</a>
                  </td>
                </tr>
              <?php $no++; }} ?>
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