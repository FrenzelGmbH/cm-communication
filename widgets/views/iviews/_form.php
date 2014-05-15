<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\web\JsExpression;
use kartik\widgets\ActiveForm;

use kartik\widgets\Select2;

/**
 * @var yii\web\View $this
 * @var app\modules\parties\models\Address $model
 * @var yii\widgets\ActiveForm $form
 */

$script = <<<SKRIPT

$('#submitAddressCreate').on('click',function(event){
  $('#AddressCreateForm').ajaxSubmit(
  {
    type : "POST",
    success: function(data){
      $('#caddressmod').modal('hide');
    }
  });
  event.preventDefault();
});

SKRIPT;

$this->registerJs($script);

?>

<div class="address-form">

  <?php $form = ActiveForm::begin([
    'id' => 'AddressCreateForm',
    'action' => Url::to(['/address/default/create']),
  ]); ?>

    <?= Html::activeHiddenInput($model,'mod_id'); ?>
    <?= Html::activeHiddenInput($model,'mod_table'); ?>

    <?= $form->field($model, 'addresslineOne')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'addresslineTwo')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'zipCode')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'cityName')->textInput(['maxlength' => 100]) ?>

<?php

$dataExp = <<< SCRIPT
  function (term, page) {
    return {
      search: term, // search term
    };
  }
SCRIPT;

$dataResults = <<< SCRIPT
  function (data, page) {
    return {
      results: data.results
    };
  }
SCRIPT;

$url = Url::to(['/address/default/jscountry']);

$fInitSelection = <<< SCRIPT
  function (element, callback) {
    var id=$(element).val();
    if (id!=="") {
      $.ajax("$url&id="+id, {
        dataType: "json"
      }).done(function(data) { callback(data.results); });
    }
  }
SCRIPT;

?>

    <?= $form->field($model, 'country_id')->widget(Select2::classname(),[
          'pluginOptions'=>[
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
              'url' => $url,
              'dataType' => 'json',
              'data' => new JsExpression($dataExp),
              'results' => new JsExpression($dataResults),
            ],
            'initSelection' => new JsExpression($fInitSelection)
          ]
    ]); ?>
  
    <?= $form->field($model, 'postBox')->textInput(['maxlength' => 100]) ?>   

    <?= $form->field($model, 'regionName')->textInput(['maxlength' => 100]) ?>    

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'submitAddressCreate']) ?>
    </div>

  <?php ActiveForm::end(); ?>

</div>
