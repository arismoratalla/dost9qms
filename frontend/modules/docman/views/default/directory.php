<?php 
use yii\bootstrap\Modal;

$this->title = 'Dashboard';
// $this->params['breadcrumbs'][] = ['label' => 'Docman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalContainer',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

//echo $model->status_id.'<br/>';
//echo Os::generateOsNumber($model->request->obligation_type_id,$model->request->request_date);
?>   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quality Management System
        <small>Directory</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <!-- <h3><?= $qm ?></h3> -->

              <p style="font-weight: bold;">FORMS MANUAL</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/docman/default/subdirectory?cat_id=2&bg=bg-aqua" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <!-- <h3><?= $op ?></h3> -->

              <p style="font-weight: bold;">PROCEDURES MANUAL</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/docman/default/subdirectory?cat_id=3&bg=bg-green" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <!-- <h3><?= $wi ?></h3> -->

              <p style="font-weight: bold;">QUALITY MANUAL</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/docman/default/subdirectory?cat_id=4&bg=bg-yellow" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <!-- <h3><?= $methods ?></h3> -->

              <p style="font-weight: bold;">WORK INSTRUCTION</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/docman/default/subdirectory?cat_id=5&bg=bg-red" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
        <!-- ./col -->
        <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <!-- <h3><?= $zeroRevisions ?></h3> -->

              <p style="font-weight: bold;">DOCUMENT CHANGE FORMS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/docman/default/subdirectory?cat_id=1&bg=bg-fuchsia" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </div>
        
      </div>

    </section>
    <!-- /.content -->