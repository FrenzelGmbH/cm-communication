<?php
/**
 * Comment item view.
 *
 * @var \yii\web\View $this View
 * @var \net\frenzel\comment\models\frontend\Comment[] $models Comment models
 * && $model->next_type == \net\frenzel\activity\models\Activity::TYPE_APPOINTMENT
 */
use yii\helpers\Url;
?>
<?php if ($model !== null) : ?>
    <div class="media" data-communication="parent" data-communication-id="<?= $model->id ?>">
        <div class="media-left">
            <i class="fa fa-<?= $model->TypeAsIcon; ?> fa-2x"></i>
        </div>
        <div class="media-body" data-communication="append">
            <div class="media-heading">
                <div>
                    <small><?= \Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                    by <?= $model->author->username ?>&nbsp;</small>
                </div> 
            </div>
            <?php if (!is_null($model->deleted_at)) { ?>
                <?= \Yii::t('net_frenzel_activity', 'deleted') ?>
            <?php } else { ?>
                <div class="content" data-communication="content"><?= $model->text ?></div>                        
            <?php } ?>
            <?php if (is_null($model->deleted_at)) { ?>
                <div data-communication="tools">
                    <?php if (Yii::$app->user->identity->isAdmin) { ?>
                        &nbsp;
                        <a href="#" data-communication="update" data-communication-id="<?= $model->id ?>" data-communication-url="<?= Url::to([
                            '/activity/default/update',
                            'id' => $model->id
                        ]) ?>" data-communication-fetch-url="<?= Url::to([
                            '/activity/default/fetch',
                            'id' => $model->id
                        ]) ?>">
                            <i class="fa fa-pencil"></i> <?= \Yii::t('app', 'update') ?>
                        </a>
                    <?php } ?>
                    <?php if (Yii::$app->user->identity->isAdmin) { ?>
                        &nbsp;
                        <a href="#" data-communication="delete" data-communication-id="<?= $model->id ?>" data-communication-url="<?= Url::to([
                            '/activity/default/delete',
                            'id' => $model->id
                        ]) ?>" data-communication-confirm="<?= \Yii::t('net_frenzel_activity', 'FRONTEND_WIDGET_ACTIVITY_DELETE_CONFIRMATION') ?>">
                            <i class="fa fa-remove"></i> <?= \Yii::t('app', 'delete') ?>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <hr>
    </div>
<?php endif; ?>
