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

/**
 * this js script allows people to press ctrl+s to save values
 * @var [type]
 */
$script = <<<SKRIPT

$('#net-communication-create-s').click(function() {
    $('#container_net_frenzel_communication_form').show( 2000 );
});

SKRIPT;

$this->registerJs($script);

?>

<div id="net-communication-create-s"><small>+ <?= \Yii::t('net_frenzel_communication','new communication'); ?></small></div>

<div id="container_net_frenzel_communication_form" style="display:none">

<div class="panel">
    <div class="panel-body">
        
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
        'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default btn-sm']]
    ])->label(false);?>
 <?= Html::error($model, 'type', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>

<div class="row">
    <div class="col-sm-9">
        <?= $form->field($model, 'text')->input('text',['class'=>'input-sm'])->label(false); ?>
        <?= Html::error($model, 'text', ['data-communication' => 'form-summary', 'class' => 'help-block hidden']) ?>
    </div>
    <div class="col-sm-3">
        <?= Html::submitButton('<i class="fa fa-plus"></i> ' . \Yii::t('net_frenzel_communication', 'add'), 
            ['class' => 'btn btn-success btn-sm']
        ); ?>     
    </div>
</div>

<?= Html::activeHiddenInput($model, 'entity') ?>
<?= Html::activeHiddenInput($model, 'entity_id') ?>
<?= Html::endForm(); ?>

    </div>
</div>

</div>