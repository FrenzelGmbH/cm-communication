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


<?= $form->field($model, 'type')->radioButtonGroup($model->TypeArray,[
        //'class' => 'btn-group-sm',
        'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default btn-xs']]
    ]);?>
 <?= Html::error($model, 'type', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>

<?= $form->field($model, 'text')->label(false); ?>
<?= Html::error($model, 'text', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>

<?= Html::submitButton('<i class="fa fa-check"></i> ' . \Yii::t('net_frenzel_communication', 'submit'), ['class' => 'btn btn-success btn-xs']); ?>

<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?= Html::endForm(); ?>
<div class="clearfix"></div>