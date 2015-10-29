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

<!--/ #communication-list -->
<div id="communication-list-info">
    <?php if ($models !== null) : ?>
        <?php foreach ($models as $model) : ?>
            <?= $this->render('_index_single_info_item', ['model' => $model]) ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<!--/ #communication-list -->
