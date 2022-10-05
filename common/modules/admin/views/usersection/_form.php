<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\system\Usersection */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="usersection-form">
     <?php
        $form = ActiveForm::begin([
                    'options' => [
                        'id' => 'assign-form'
                    ]
        ]);
    ?>   


    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                    'data' => $listUsers,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Users', 'id'=>'group-user_id', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

    <?= $form->field($model, 'section_id')->widget(Select2::classname(), [
                    'data' => $listSections,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Section/Unit', 'id'=>'group-section_id'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
                
    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
                    'data' => $listProjects,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Project', 'id'=>'group-project_id'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Assign' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
