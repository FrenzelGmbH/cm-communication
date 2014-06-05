<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\SideNav;
use yii\widgets\Pjax;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\CommunicationSearch $searchModel
 */

$this->title = Yii::t('app', 'Communications');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

    <?php 
    $sideMenu = array();
    $sideMenu[] = array('icon'=>'book','label'=>Yii::t('cm-communication','Communications'),'url'=>Url::to(array('/communication/communication/index')));
    $sideMenu[] = array('icon'=>'plus','label'=>Yii::t('cm-communication','New Communication'),'url'=>Url::to(array('/communication/communication/create')));
    $sideMenu[] = array('icon'=>'tower','label'=>Yii::t('cm-communication','Playground'),'url'=>Url::to(array('/communication/default/test')));

    echo SideNav::widget([
      'type' => SideNav::TYPE_INFO,
      'heading' => \Yii::t('cm-communication','Communication Menu'),
      'items' => $sideMenu
    ]);
  ?>

<?php yii\widgets\Block::end(); ?>

<div class="workbench">

    <h1 class="page-header"><?= Html::encode($this->title) ?></h1>

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
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Communications</h3>',
            'type' => 'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Communication', ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ]
    ]); 
Pjax::end();
?>

</div>
