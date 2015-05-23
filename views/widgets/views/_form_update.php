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

<div class="panel panel-default">
    <div class="panel-body">
<?php $form = ActiveForm::begin([
        'action' => ['/communication/default/update','id' => $model->id], 
        'method' => 'POST', 
        'options' => [
            'class' => 'form-horizontal', 
            'data-communication' => 'form', 
            'data-communication-action' => 'update',
            'data-communication-id' => $model->id,
        ]
    ]
) ?>


<?= $form->field($model, 'type')->radioButtonGroup($model->TypeArray,[
        //'class' => 'btn-group-sm',
        'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default btn-xs']]
    ])->label(false);?>
 <?= Html::error($model, 'type', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>

<?= $form->field($model, 'text'); ?>
<?= Html::error($model, 'text', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>

<?= Html::submitButton('<i class="fa fa-check"></i> ' . \Yii::t('net_frenzel_communication', 'submit'), ['class' => 'btn btn-success btn-m']); ?>

<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?= Html::endForm(); ?>

    </div>
</div>
<div class="clearfix"></div>