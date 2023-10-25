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

/* @var $this yii\web\View */
/* @var $searchModel common\models\docman\IssuanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Issuances';
$this->params['breadcrumbs'][] = $this->title;

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

use frontend\modules\docman\components\SynologyService;

$username = "dost9ict";
$password = "D057R3g10n9";

$sid = SynologyService::login($username, $password);

print_r($sid);
?>
<div class="issuance-index">

<?php Pjax::begin(); ?>
      <?php
        echo GridView::widget([
            'id' => 'issuance',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'columns' => [
                            [
                                'attribute'=>'subject',
                                'label'=>'Subject',
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                            [
                                'attribute'=>'code',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: left;'],
                                'width'=>'120px',
                                'format'=>'raw',
                            ],
                            [
                                'class' => kartik\grid\ActionColumn::className(),
                                'template' => '{download}',
                                'buttons' => [
                                    'download' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', 
                                            ['issuance/download', 'id' => $model->issuance_id, 'year' => $_GET['year']], 
                                            [
                                                'title' => Yii::t('app', 'ctrl + click to download'),
                                                'class' => 'btn btn-primary',
                                                // 'target' => '_blank'
                                            ]
                                        );
                                    },
                                ],
                            ]
                    ],
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
//                    'heading' => $this->title,
                    'heading' => '<h2 class="panel-title"><i class="fas fa-file"></i> '.$this->title.'</h2>',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  Html::button(
                        '<i class="fas fa-plus"></i> Add', 
                        ['value' => Url::to([
                            'issuance/create', 
                            'issuance_type_id' => $_GET['issuance_type_id']]), 
                            'title' => 'Add Issuance', 
                            'class' => 'btn btn-info', 
                            'style'=>'margin-right: 6px; '
                                .( ( (Yii::$app->user->identity->username == 'Admin') || Yii::$app->user->can('ord-secretariate')) ? '' : 'display: none;'), 
                            'id'=>'buttonCreateIssuance'
                        ]),
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
