<script type="text/javascript">
    $(function() {
        $(".knob").knob();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

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

use common\models\cashier\Creditor;
use common\models\finance\Request;
use common\models\finance\Requestdistrict;
use common\models\finance\Requeststatus;
use common\models\procurement\Division;
use common\models\system\Profile;
use common\models\system\Usersection;
use common\models\sec\Blockchain;
/* @var $this yii\web\View */
/* @var $searchModel common\models\finance\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blockchain Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>
      <?php
        echo GridView::widget([
            'id' => 'request',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
            'headerRowOptions' => ['class' => 'kartik-sheet-style'],
            'filterRowOptions' => ['class' => 'kartik-sheet-style'],
            'columns' => [
                            [
                                'attribute'=>'scope',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'vertical-align:middle; text-align: center;'],
                                'width'=>'120px',
                                'format'=>'raw',
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map([['id'=>'Osdv','scope'=>'Osdv'],['id'=>'Request','scope'=>'Request'],['id'=>'Requestattachment','scope'=>'Attachment']], 'id', 'scope'), 
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => false],
                                ],  
                                'filterInputOptions' => ['placeholder' => 'Select Scope'],
                            ],
                            [
                                'attribute'=>'index_id',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'text-align: center;'],
                                'width'=>'20%',
                                'format'=>'raw',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    
                                    switch ($model->scope) {
                                      case 'Request':
                                        $label = $model->request->request_number;
                                        $link = '/finance/request/view';
                                        break;
                                      case 'Requestattachment':
                                        $label = '-';
                                        $link = '/finance/request/view';
                                        break;
                                      case 'Osdv':
                                        $label = $model->osdv->dv ? $model->osdv->dv->dv_number : '-';
                                        $link = '/finance/osdv/view';
                                        break;

                                      default:
                                        $label = '-';
                                        $link = '/-';
                                    }
                                    
                                    return '<b>'.Html::a($label, [$link, 'id'=>$model->index_id], ['style' => 'font-size: medium;', 'target' => '_blank', 'data-pjax'=>0]).'</b><br/>'.date('Y-m-d H:i:s',$model->timestamp);
                                },
                            ],
                            [
                                'attribute'=>'data',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'padding-left: 25px; font-weigth: bold;'],
                                'width'=>'800px',
                                'contentOptions' => [
                                    'style'=>'max-width:300px; overflow: auto; white-space: normal; word-wrap: break-word;'
                                ],
                            ],
                            [
                                'attribute'=>'user_id',
                                'headerOptions' => ['style' => 'text-align: center;'],
                                'contentOptions' => ['style' => 'text-align: center; vertical-align:middle; '],
                                'width'=>'250px',
                                'value'=>function ($model, $key, $index, $widget) { 
                                    return $model->profile->fullname;
                                },
                                'filterType' => GridView::FILTER_SELECT2,
                                'filter' => ArrayHelper::map(Profile::find()->asArray()->all(), 'profile_id', 
                                                                function($model) {
                                                                    return $model['firstname'].' '.$model['lastname'];
                                                                }
                                                            ), 
                                'filterWidgetOptions' => [
                                    'pluginOptions' => ['allowClear' => true],
                                ],  
                                'filterInputOptions' => ['placeholder' => 'UserID'],
                            ],
                    ],
            
            'pjax' => true, // pjax is set to always true for this demo
            'panel' => [
                    'heading' => '',
                    'type' => GridView::TYPE_PRIMARY,
                    'before'=>  '',
                    'after'=>false,
                ],
            // set your toolbar
        
            'toggleDataOptions' => ['minCount' => 10],
            //'exportConfig' => $exportConfig,
            'itemLabelSingle' => 'item',
            'itemLabelPlural' => 'items'
        ]);
    

        ?>
        <?php Pjax::end(); ?>
</div>