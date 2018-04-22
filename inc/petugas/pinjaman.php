<div class="row">
<ol class="breadcrumb">
  <li><a href="?menu=dashboard">
    <em class="fa fa-home"></em>
  </a></li>
  <li class="active">Pinjaman</li>
</ol>
</div>

<div class="row">
<div class="col-lg-12">
  <h1 class="page-header">Pinjaman</h1>
</div>
</div>

<div class="row">
<div class="col-lg-12">
  <div class="panel panel-default">
    <div class="panel-heading">
        Kategori Pinjaman
        <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
    </div>
    <div class="panel-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pilihan</label>
                <select  class="form-control" name="kategori" id="kategori">
                  <option disabled selected>Pilih Kategori</option>
                  <?php foreach($run->showData('kategori_pinjaman order by nama_pinjaman asc') as $r): ?>
                  <option value="<?=$r->id_kategori_pinjaman?>"><?=$r->nama_pinjaman?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <a href="?menu=kategori-pinjaman" class="aga-kecil">Tidak ada kategori?</a><br><br>
            <button type="submit" class="btn btn-primary">Proses</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </div>
        
      </div>
    </div>
  </div><!-- /.panel-->
</div>