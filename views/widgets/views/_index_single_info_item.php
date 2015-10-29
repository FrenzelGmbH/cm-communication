<?php
/**
 * Comment item view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 * && $model->next_type == \net\frenzel\communication\models\communication::TYPE_APPOINTMENT
 */
use yii\helpers\Url;
?>
<?php if ($model !== null) : ?>
    <div class="row">
        <div class="col-sm-12">
        <?php if (!is_null($model->deleted_at)) { ?>
            <div style="color:red">
        <?php } ?>
            <i class="fa fa-<?= $model->TypeAsIcon; ?>"></i>
            <?= $model->TextAsLink; ?>
        <?php if (!is_null($model->deleted_at)) { ?>
            </div>
        <?php } ?>
        </div>
    </div>
<?php endif; ?>
