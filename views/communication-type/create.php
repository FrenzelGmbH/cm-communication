<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\CommunicationType $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Communication Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Communication Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="communication-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
