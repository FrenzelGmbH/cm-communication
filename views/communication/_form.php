<?php

use yii\helpers\Html;

use frenzelgmbh\cmcommunication\models\CommunicationType;

use kartik\widgets\ActiveForm;
use kartik\widgets\Select2

/**
 * @var yii\web\View $this
 * @var app\models\Communication $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="communication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo $form->field($model, 'communication_type_id')->widget(Select2::classname(), [
            'data' => array_merge(["" => ""], CommunicationType::pdCommunicationType()),
            'options' => ['placeholder' => 'Communication Type...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'mobile',[
            'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone"></i>']]
        ])->textInput(['maxlength' => 200]) 
    ?>        
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'phone',[
            'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-phone-alt"></i>']]
        ])->textInput(['maxlength' => 200]) 
    ?>        
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'email',[
            'addon' => ['prepend' => ['content'=>'@']]
        ])->textInput(['maxlength' => 200]) 
    ?>        
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'fax',[
            'addon' => ['prepend' => ['content'=>'<i class="glyphicon glyphicon-print"></i>']]
        ])->textInput(['maxlength' => 200]) 
    ?>       
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
