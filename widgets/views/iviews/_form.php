<?php

use yii\helpers\Url;

use frenzelgmbh\cmcommunication\models\CommunicationType;

use kartik\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;

use yii\bootstrap\Modal;

/**
 * @var yii\web\View $this
 * @var app\models\Communication $model
 * @var yii\widgets\ActiveForm $form
 */
$script = <<<SKRIPT

$('#submitCommunicationCreate').on('click',function(event){
  $('#CommunicationCreateForm').ajaxSubmit(
  {
    type : "POST",
    success: function(data){
      $('#ccommunicationmod').modal('hide');
    }
  });
  event.preventDefault();
});

SKRIPT;

$this->registerJs($script);

?>

<?php 
  
Modal::begin([
  'id'=>'ccomtype',
  'header' => '<i class="fa fa-info"></i>Loading...',
  'closeButton' => ['tag'=>'button','label'=>'close']
]);
echo 'pls. wait one moment...';
Modal::end();

$modalJS = <<<MODALJS

appendcomtype = function(data){
    var model = data.model;
    $('#communication-communication_type_id').append('<option value="' + model.id + '">' + model.name + '</option>');
}

openccomtypemod = function(){
    var th=$(this), id=th.attr('id').slice(0);  
    $('#ccomtype').modal('show');
    $('#ccomtype div.modal-header').html('Add Address');
    $('#ccomtype div.modal-body').load(th.attr('href'));
    return false;
};

$('#mod_communication_type_add').on('click',openccomtypemod);

MODALJS;

  $this->registerJs($modalJS);

?>

<div class="communication-form">

    <?php $form = ActiveForm::begin([
      'id' => 'CommunicationCreateForm',
      'action' => Url::to(['/address/default/create']),
    ]); ?>

    <?php
        echo $form->field($model, 'communication_type_id')->widget(Select2::classname(), [
            'data' => array_merge(["" => ""], CommunicationType::pdCommunicationType()),
            'options' => [
                'placeholder' => 'Communication Type...'                
            ],
            'addon' => [
                'prepend' => [
                    'content' => Html::icon('globe')
                ],
                'append' => [
                    'content' => Html::button(Html::icon('plus'), [
                        'class'=>'btn btn-default',
                        'id'   => 'mod_communication_type_add', 
                        'title'=>'add new type', 
                        'data-toggle'=>'tooltip',
                        'href' => Url::to(['/communication/communication-type/create'])
                    ]),
                    'asButton'=>true
                ]
            ],
            'pluginOptions' => [
                'allowClear' => true,
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

    <div class="form-group navbar navbar-primary">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'],'id'=>'submitCommunicationCreate') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
