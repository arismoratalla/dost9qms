<?php 
use yii\bootstrap\Modal;

$this->title = 'Dashboard';
// $this->params['breadcrumbs'][] = ['label' => 'Docman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $cat->name;

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
        <?= $cat->name ?>
        <small>Directory</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
        <div class="row">

            <?php foreach($sections as $section) {?>
                <div class="col-lg-4 col-xs-8">
                <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <p><?= $section->name ?></p>
                            </div>
                            <div class="icon" style="bg-color: green">
                            <!-- <i class="ion ion-bag"></i> -->
                            </div>
                            <a href="/docman/doc/index?section_id=<?= $section->section_id?>" target="_blank" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                </div>
            
            <?php } ?>
        
        </div>

    </section>
    <!-- /.content -->