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
// echo Yii::$app->user->identity->profile->groups;
// echo '<br/>';
// print_r( explode(',', Yii::$app->user->identity->profile->groups) );
//echo Os::generateOsNumber($model->request->obligation_type_id,$model->request->request_date);
?>   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registry Dashboard
        <small>Statistics</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $risks ?></h3>

              <p>&nbsp;</p>
              <p>RISKS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $opportunities ?></h3>

              <p>&nbsp;</p>
              <p>OPPORTUNITIES</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $drafts ?></h3>

              <p>&nbsp;</p>
              <p>DRAFTS</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-6 col-xs-6">
        <div class="col-lg-6 col-xs-6">
          <!-- /.info-box -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mastery in Risk Management</span>
              <span class="info-box-number">At least 2 in all areas</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          <!-- </div> -->
          </div>
          </div>
          <div class="col-lg-6 col-xs-6">
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mastery in Opportunity Management</span>
              <span class="info-box-number">At least 1 in all areas</span>

              <div class="progress">
                <div class="progress-bar" style="width: 80%"></div>
              </div>
              <span class="progress-description">
                    20% Increase in 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </div>
          <!-- /.info-box -->
        </div>



      </div>


      
    </section>
