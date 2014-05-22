<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\CommunicationSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="communication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'fax') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'mod_table') ?>

    <?php // echo $form->field($model, 'mod_id') ?>

    <?php // echo $form->field($model, 'system_key') ?>

    <?php // echo $form->field($model, 'system_name') ?>

    <?php // echo $form->field($model, 'system_upate') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'communication_type_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
