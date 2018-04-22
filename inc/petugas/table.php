
<div class="row">
  <ol class="breadcrumb">
    <li><a href="#">
      <em class="fa fa-home"></em>
    </a></li>
    <li class="active">Tables</li>
  </ol>
</div><!--/.row-->

<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Tables</h1>
  </div>
</div><!--/.row-->    

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">Data Table</div>
      <div class="panel-body">
        <div class="bootstrap-table"><div class="fixed-table-toolbar"><div class="columns btn-group pull-right"><button class="btn btn-default" type="button" name="refresh" title="Refresh"><i class="glyphicon glyphicon-refresh icon-refresh"></i></button><button class="btn btn-default" type="button" name="toggle" title="Toggle"><i class="glyphicon glyphicon glyphicon-list-alt icon-list-alt"></i></button><div class="keep-open btn-group" title="Columns"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="glyphicon glyphicon-th icon-th"></i> <span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li><label><input type="checkbox" data-field="id" value="1" checked="checked"> Item ID</label></li><li><label><input type="checkbox" data-field="name" value="2" checked="checked"> Item Name</label></li><li><label><input type="checkbox" data-field="price" value="3" checked="checked"> Item Price</label></li></ul></div></div><div class="pull-right search"><input class="form-control" type="text" placeholder="Search"></div></div><div class="fixed-table-container"><div class="fixed-table-header"><table></table></div><div class="fixed-table-body"><div class="fixed-table-loading" style="top: 37px; display: none;">Loading, please wait…</div><table data-toggle="table" data-url="tables/data1.json" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" class="table table-hover">
          <thead>
            <tr><th class="bs-checkbox " style="width: 36px; "><div class="th-inner "><input name="btSelectAll" type="checkbox"></div><div class="fht-cell"></div></th><th style=""><div class="th-inner sortable">Item ID</div><div class="fht-cell"></div></th><th style=""><div class="th-inner sortable">Item Name<span class="order"><span class="caret" style="margin: 10px 5px;"></span></span></div><div class="fht-cell"></div></th><th style=""><div class="th-inner sortable">Item Price</div><div class="fht-cell"></div></th></tr>
          </thead>
        <tbody><tr data-index="0"><td class="bs-checkbox"><input data-index="0" name="toolbar1" type="checkbox"></td><td style="">9</td><td style="">Item 9</td><td style="">$9</td></tr><tr data-index="1"><td class="bs-checkbox"><input data-index="1" name="toolbar1" type="checkbox"></td><td style="">8</td><td style="">Item 8</td><td style="">$8</td></tr><tr data-index="2"><td class="bs-checkbox"><input data-index="2" name="toolbar1" type="checkbox"></td><td style="">7</td><td style="">Item 7</td><td style="">$7</td></tr><tr data-index="3"><td class="bs-checkbox"><input data-index="3" name="toolbar1" type="checkbox"></td><td style="">6</td><td style="">Item 6</td><td style="">$6</td></tr><tr data-index="4"><td class="bs-checkbox"><input data-index="4" name="toolbar1" type="checkbox"></td><td style="">5</td><td style="">Item 5</td><td style="">$5</td></tr><tr data-index="5"><td class="bs-checkbox"><input data-index="5" name="toolbar1" type="checkbox"></td><td style="">4</td><td style="">Item 4</td><td style="">$4</td></tr><tr data-index="6"><td class="bs-checkbox"><input data-index="6" name="toolbar1" type="checkbox"></td><td style="">3</td><td style="">Item 3</td><td style="">$3</td></tr><tr data-index="7"><td class="bs-checkbox"><input data-index="7" name="toolbar1" type="checkbox"></td><td style="">20</td><td style="">Item 20</td><td style="">$20</td></tr><tr data-index="8"><td class="bs-checkbox"><input data-index="8" name="toolbar1" type="checkbox"></td><td style="">2</td><td style="">Item 2</td><td style="">$2</td></tr><tr data-index="9"><td class="bs-checkbox"><input data-index="9" name="toolbar1" type="checkbox"></td><td style="">19</td><td style="">Item 19</td><td style="">$19</td></tr></tbody></table></div><div class="fixed-table-pagination"><div class="pull-left pagination-detail"><span class="pagination-info">Showing 1 to 10 of 21 rows</span><span class="page-list"><span class="btn-group dropup"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="page-size">10</span> <span class="caret"></span></button><ul class="dropdown-menu" role="menu"><li class="active"><a href="javascript:void(0)">10</a></li><li><a href="javascript:void(0)">25</a></li><li><a href="javascript:void(0)">50</a></li><li><a href="javascript:void(0)">100</a></li></ul></span> records per page</span></div><div class="pull-right pagination"><ul class="pagination"><li class="page-first disabled"><a href="javascript:void(0)">&lt;&lt;</a></li><li class="page-pre disabled"><a href="javascript:void(0)">&lt;</a></li><li class="page-number active disabled"><a href="javascript:void(0)">1</a></li><li class="page-number"><a href="javascript:void(0)">2</a></li><li class="page-number"><a href="javascript:void(0)">3</a></li><li class="page-next"><a href="javascript:void(0)">&gt;</a></li><li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li></ul></div></div></div></div><div class="clearfix"></div>
      </div>
    </div>
  </div>

  
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">Bordered Table</div>
      <div class="panel-body btn-margins">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Col 1</th>
                <th>Col 2</th>
                <th>Col 3</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Col 1</td>
                <td>Col 2</td>
                <td>Col 3</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Col 1</td>
                <td>Col 2</td>
                <td>Col 3</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Col 1</td>
                <td>Col 2</td>
                <td>Col 3</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.panel-->
    <div class="panel panel-default">
      <div class="panel-heading">Table with Hover</div>
      <div class="panel-body btn-margins">
        <div class="col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Row</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John</td>
                <td>Carter</td>
                <td>johncarter@mail.com</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Peter</td>
                <td>Parker</td>
                <td>peterparker@mail.com</td>
              </tr>
              <tr>
                <td>3</td>
                <td>John</td>
                <td>Rambo</td>
                <td>johnrambo@mail.com</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.panel-->
  </div><!-- /.col-->
</div><!--/.row-->