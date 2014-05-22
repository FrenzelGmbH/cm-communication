<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Communication $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Communications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="communication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'mobile',
            'phone',
            'fax',
            'email:email',
            'user_id',
            'mod_table',
            'mod_id',
            'system_key',
            'system_name',
            'system_upate',
            'created_at',
            'updated_at',
            'deleted_at',
            'communication_type_id',
        ],
    ]) ?>

</div>
