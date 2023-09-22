<?php
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

use kartik\datecontrol\DateControl;
use kartik\detail\DetailView;
use kartik\editable\Editable; 
use kartik\grid\GridView;

use yii\bootstrap\Modal;
use frontend\modules\docman\components\SynologyService;

/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $category->name;

// Modal Create Request
Modal::begin([
    'header' => '<h4 id="modalHeader" style="color: #ffffff"></h4>',
    'id' => 'modalRequest',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

// Modal Create New Creditor
Modal::begin([
    'header' => '<h4 id="modalCreditorHeader" style="color: #ffffff"></h4>',
    'id' => 'modalCreditor',
    'size' => 'modal-md',
    'options'=> [
             'tabindex'=>false,
        ],
]);

echo "<div id='modalContent'><div style='text-align:center'><img src='/images/loading.gif'></div></div>";
Modal::end();

/*
$username = "dost9ict";
$password = "D057R3g10n9";
$filePath = "/Fileserver/1_ORD/Issuances/Memo/2013/02Apr_Submission of SALN.pdf";

$sid = SynologyService::login($username, $password);

if ($sid) {
    // $data = SynologyService::getFolderContents($sid, $folderPath);
    // print_r($data);

    $fileContent = SynologyService::downloadFile($sid, $filePath);
    
    // Example: Directly send the file to the browser for user download
    if ($fileContent) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        // echo $fileContent;
    }

} else {
    echo "Login failed.";
}*/

?>
<div class="request-index">

<?php Pjax::begin(); ?>
      <?php
        echo GridView::widget([
            'id' => 'request',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
//            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
//            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'columns' => [
//                          'document_id',
                            [
                                'attribute'=>'section_id',
                                'label'=>'Section',
                                'width'=>'120px',
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->section->name;
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map($sections, 'section_id', 'name'), 
                            ],
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: left;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                            [
                                'attribute'=>'name',
                                'label'=>'Name',
                                'width'=>'120px',
                                'format'=>'raw',
                                // 'value'=>function ($model, $key, $index, $widget) { 
                                //     if($_GET['qms_type_id'] == 1) {
                                //         return ($model->category_id == 2) ? 'Procedures Manual' : $model->category->name ;
                                //     } elseif($_GET['qms_type_id'] == 2){
                                //         return ($model->category_id == 2) ? 'Operational Procedure' : $model->category->name;
                                //     }
                                // },
                                // 'filterType' => GridView::FILTER_SELECT2,
                                // 'filter' => ArrayHelper::map($section, 'section_id', 'name'), 
                            ],
                            [
                                'attribute'=>'effectivity_date',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                                            [
                                'attribute'=>'revision_num',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
                                'value' => function($model, $key, $index, $widget){
                                    return ($model->revision_num < 0 ) ? 'N/A' : $model->revision_num;
                                }
                            ],
                            [
                                'class' => kartik\grid\ActionColumn::className(),
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function ($url, $model){
                                        // return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['value' => '/docman/doc/view?id=' . $model->doc_id,'onclick'=>'location.href=this.value', 'class' => 'btn btn-primary', 'title' => Yii::t('app', "View Document")]);
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [

                                            'title' => Yii::t('app', 'ctrl + click me')], ['class' => 'btn btn-primary', 'target'=>'_blank' ]);
                                    },
                                ],
                                'buttonOptions' => [
                                    'target' => "_blank"
                                 ]
                            ],
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
//                    'heading' => $this->title,
                    'heading' => '<h2 class="panel-title"><i class="fas fa-file"></i> '.$this->title.'</h2>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  '',//Html::button('<i class="fas fa-plus"></i> Add', ['value' => Url::to(['document/create', 'qms_type_id' => $_GET['qms_type_id'], 'category_id' => $_GET['category_id']]), 'title' => 'Add Document', 'class' => 'btn btn-info', 'style'=>'margin-right: 6px; '.( ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('17025-document-custodian')) ? '' : 'display: none;'), 'id'=>'buttonCreateRequest']),
                    'after'=>false,
                ],

            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'exportConfig' => [
                'html' => [],
                'csv' => [],
                'txt' => [],
                'xls' => [],
                'pdf' => [],
                'json' => [],
            ],

            // set your toolbar
            'toolbar' => 
                        [
                            [
                                // 'content'=> $category_menus . $toolbars,
                                // 'content'=> ($category_id == 5) ? $toolbars : '',
                                'content'=> '',
                                'options' => ['class' => 'btn-group mr-2 me-2']
                            ],
                            '{export}',
                            //'{toggleData}'
                        ],
            
            'toggleDataOptions' => ['minCount' => 10],
            //'exportConfig' => $exportConfig,
            'itemLabelSingle' => 'item',
            'itemLabelPlural' => 'items'
        ]);
    

        ?>
        <?php Pjax::end(); ?>
</div>