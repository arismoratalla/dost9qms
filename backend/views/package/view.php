<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Package */

$this->title = ucwords($model->PackageName);
$this->params['breadcrumbs'][] = ['label' => 'Packages', 'url' => ['/package']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="package-view">
    <div class="panel panel-default col-xs-12">
        <div class="panel-heading"><i class="fa fa-user-circle fa-adn"></i> View <?= $this->title ?></div>
        <div class="panel-body">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->PackageID], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->PackageID], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'PackageID',
                    'PackageName',
                    [
                        'attribute' => 'icon',
                        'label' => 'Icon Name',
                    ],
                    [
                        'attribute' => 'icon',
                        'label' => 'Icon',
                        'format' => 'raw',
                        'value' => function($model) {
                            return "<span class='" . $model->icon . "'><span>";
                        }
                    ],
                    'created_at:date',
                    'updated_at:date',
                ],
            ])
            ?>
        </div>
    </div>
</div>
