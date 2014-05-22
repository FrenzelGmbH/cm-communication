<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frenzelgmbh\cmcommunication\models\CommunicationType;

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

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
