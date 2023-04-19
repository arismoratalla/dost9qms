<?php 
use yii\bootstrap\Modal;
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use kartik\grid\GridView;

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
/*
$date = date('Y-m-d');
echo $date;
echo '<br/>';
$month = date('n');
echo $month;
echo '<br/>';
$day = getdate(date("U"));
echo "$day[mday]";
echo '<br/>';
$qtr = ceil($month / 3);
echo $qtr;
echo '<br/>';
echo date('Y');
*/
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
      <br />
      <?= $toolbars ?>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        <div class="col-lg-3 col-xs-6">
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

        <div class="col-lg-3 col-xs-6">
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

        <div class="col-lg-3 col-xs-6">
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
        
      </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-lg-4 col-xs-6">
      <?php
        echo Highcharts::widget([
          'scripts' => [
              // 'modules/exporting',
              // 'themes/grid-light',
          ],
          'options' => [
              'title' => [
                  'text' => 'Risks by Area',
              ],
              'series' => [
                  [
                      'type' => 'pie',
                      'name' => 'Total',
                      'data' => $pieRisks,
                      'center' => [240, 150],
                      'size' => 200,
                      'showInLegend' => false,
                      'dataLabels' => [
                          'enabled' => true,
                      ],
                  ],
              ],
          ]
        ]);
      ?>
    </div>

    <div class="col-lg-4 col-xs-6">
      <?php
        echo Highcharts::widget([
          'scripts' => [
              // 'modules/exporting',
              // 'themes/grid-light',
          ],
          'options' => [
              'title' => [
                  'text' => 'Opportunities by Area',
              ],
              'series' => [
                  [
                      'type' => 'pie',
                      'name' => 'Total',
                      'data' => $pieOpportunities,
                      'center' => [240, 150],
                      'size' => 200,
                      'showInLegend' => false,
                      'dataLabels' => [
                          'enabled' => true,
                      ],
                  ],
              ],
          ]
        ]);
      ?>
    </div>
  </div>
</section>