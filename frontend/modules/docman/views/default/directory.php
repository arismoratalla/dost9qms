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
      <div class="row" style="margin-top: 100px;">
        <div class="col-lg-2 col-xs-6"></div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
          
            <div class="inner">
              <p style="font-size: 24px; font-weight: bold;">QUALITY MANUAL</p>
              <h3 style="font-size: 60px; font-weight: bold; float: right; margin-right: 20px;"><?= $qm ?></h3>
            </div>
            <br/><br/><br/><br/>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/docman/default/section?cat_id=1&bg=bg-aqua" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <p style="font-size: 24px; font-weight: bold;">PROCEDURES MANUAL</p>
              <h3 style="font-size: 60px; font-weight: bold; float: right; margin-right: 20px;"><?= $pm ?></h3>
            </div>
            <br/><br/><br/><br/>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/docman/default/section?cat_id=2&bg=bg-green" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6"></div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <p style="font-size: 24px; font-weight: bold;">WORK INSTRUCTION MANUAL</p>
              <h3 style="font-size: 60px; font-weight: bold; float: right; margin-right: 20px;"><?= $wi ?></h3>
            </div>
            <br/><br/><br/><br/>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/docman/default/section?cat_id=3&bg=bg-yellow" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <p style="font-size: 24px; font-weight: bold;">FORMS MANUAL</p>
              <h3 style="font-size: 60px; font-weight: bold; float: right; margin-right: 20px;"><?= $fm ?></h3>
            </div>
            <br/><br/><br/><br/>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/docman/default/section?cat_id=4&bg=bg-red" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- ./col -->
        
      <!-- </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <p style="font-weight: bold;">MASTERLIST OF RECORDS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/docman/default/section?cat_id=5&bg=bg-fuchsia" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </div>
      </div> -->

    </section>
    <!-- /.content -->