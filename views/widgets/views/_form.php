<?php
/**
 * Comment widget form view.
 * @var \yii\web\View $this View
 * @var \yii\widgets\ActiveForm $form Form
 * @var \net\frenzel\comment\models\frontend\Comment $model New comment model
 */
use yii\helpers\Html;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;

?>

<?php $form = ActiveForm::begin([
        'action' => ['/communication/default/create'], 
        'method' => 'POST', 
        'options' => [
            'class' => 'form-horizontal', 
            'data-communication' => 'form', 
            'data-communication-action' => 'create'
        ]
    ]
) ?>

<div class="row" data-communication="form-group">
    <div class="col-sm-6">
        <?= $form->field($model, 'type')->radioButtonGroup($model->TypeArray,[
                //'class' => 'btn-group-sm',
                'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
            ])->label(false);?>
         <?= Html::error($model, 'type', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>
    </div>
    <div class="col-sm-6">
        <?= yii\widgets\MaskedInput::widget([
                'model' => $model,
                'attribute' => 'text',
                'mask' => ['+99-999-99999999', '9999-999-99999999'],
                'options' => ['class' => 'input-m'],
            ]);?>
        <?= Html::error($model, 'text', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-check"></i> ' . \Yii::t('net_frenzel_communication', 'submit'), ['class' => 'btn btn-success btn-m']); ?>
    </div>
</div>

<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?= Html::endForm(); ?>
<div class="clearfix"></div>