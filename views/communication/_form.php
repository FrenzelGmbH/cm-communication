<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Communication $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="communication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'mod_id')->textInput() ?>

    <?= $form->field($model, 'system_upate')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'communication_type_id')->textInput() ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'mod_table')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'system_key')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'system_name')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
