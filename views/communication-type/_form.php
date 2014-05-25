<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;

//suppress reload of existing asstes in main window
$this->assetBundles['yii\bootstrap\BootstrapAsset'] = new yii\web\AssetBundle;

/**
 * @var yii\web\View $this
 * @var app\models\CommunicationType $model
 * @var yii\widgets\ActiveForm $form
 */

$script = <<<SKRIPT

$('#submitCommunicationType').on('click',function(event){
  $('#CommunicationTypeForm').ajaxSubmit(
  {
    type : "POST",
    success: function(data){
      appendcomtype(data);
      $('#ccomtype').modal('hide');
    }
  });
  event.preventDefault();
});

SKRIPT;

$this->registerJs($script);

?>

<div class="communication-type-form">

    <?php $form = ActiveForm::begin([
        'action' => Url::to(['/communication/communication-type/create']),
        'id' => 'CommunicationTypeForm'
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submitCommunicationType']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
