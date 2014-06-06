<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\AddressSearch $searchModel
 */

?>
<div class="communication-grid">

<?php 
Pjax::begin();

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'mobile',
            'phone',
            'fax',
            'email:email',
            // 'user_id',
            // 'mod_table',
            // 'mod_id',
            // 'system_key',
            // 'system_name',
            // 'system_upate',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',
            // 'communication_type_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Communicatinos</h3>',
            'type' => 'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Communication', ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ]
    ]); 

Pjax::end(); 
?>

</div>
