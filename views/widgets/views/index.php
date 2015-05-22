<?php
/**
 * communication list view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\communication\models\Communication[] $models communication models
 * @var \net\frenzel\communication\models\Communication $model New communication model
 *
 * style="max-height:280px; overflow-y:scroll;"
 */

?>

<div id="communication">

<?php if (!\Yii::$app->user->isGuest) : ?>	        
    <?= $this->render('_form', ['model' => $model]); ?>
<?php endif; ?>		
<!--/ #communication-list -->
<div id="communication-list" data-communication="list">
    <?= $this->render('_index_item', ['models' => $models]) ?>
</div>
<!--/ #communication-list -->		
