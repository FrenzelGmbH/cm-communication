<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

?>

<?php 
  
Modal::begin([
  'id'=>'ccommunicationmod',
  'header' => '<i class="fa fa-info"></i>Loading',
]);
echo 'pls. wait one moment...';
Modal::end();

$modalJS = <<<MODALJS

opencommunicationmod = function(){
    var th=$(this), id=th.attr('id').slice(0);  
    $('#ccommunicationmod').modal('show');
    $('#ccommunicationmod div.modal-header').html('Add Communication');
    $('#ccommunicationmod div.modal-body').load(th.attr('href'));
    return false;
};

$('#mod_communication_add').on('click',opencommunicationmod);

MODALJS;

  $this->registerJs($modalJS);

?>

<?= Html::a(\Yii::t('app','Create'), [
    '/communication/default/create',
    'module' => $module, 
    'id' => $id,
  ], 
  [
    'class' => 'btn btn-info navbar-btn',
    'id' => 'mod_communication_add'
  ]
);?>
