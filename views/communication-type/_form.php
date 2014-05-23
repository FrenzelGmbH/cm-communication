<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\CommunicationType $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="communication-type-form">

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['/communication/communication-type/create']),
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
