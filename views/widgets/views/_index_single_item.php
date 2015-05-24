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
    <div data-communication="parent" data-communication-id="<?= $model->id ?>">            
        <div data-communication="append">            
            <div data-communication="content">
            <div class="row">
                <div class="col-sm-9">
                <?php if (!is_null($model->deleted_at)) { ?>
                    <div style="color:red">
                <?php } ?>
                    <i class="fa fa-<?= $model->TypeAsIcon; ?>"></i> 
                    <?= $model->text ?>
                <?php if (!is_null($model->deleted_at)) { ?>
                    </div>
                <?php } ?>
                </div>
                <div class="col-sm-3">
                    <?php if (is_null($model->deleted_at)) { ?>
                        <div data-communication="tools">
                            &nbsp;
                            <a href="#" data-communication="update" data-communication-id="<?= $model->id ?>" data-communication-url="<?= Url::to([
                                '/communication/default/update',
                                'id' => $model->id
                            ]) ?>" data-communication-fetch-url="<?= Url::to([
                                '/communication/default/fetch',
                                'id' => $model->id
                            ]) ?>" class="btn btn-default btn-sm">
                                <i class="fa fa-pencil"></i> <?= \Yii::t('app', 'u') ?>
                            </a>
                            <?php if (Yii::$app->user->identity->isAdmin) { ?>
                                &nbsp;
                                <a href="#" data-communication="delete" data-communication-id="<?= $model->id ?>" data-communication-url="<?= Url::to([
                                    '/communication/default/delete',
                                    'id' => $model->id
                                ]) ?>" data-confirm="<?= \Yii::t('net_frenzel_communication', 'FRONTEND_WIDGET_COMMUNICATION_DELETE_CONFIRMATION') ?>" class="btn btn-danger btn-sm">
                                    <i class="fa fa-remove"></i> <?= \Yii::t('app', 'd') ?>
                                </a>
                            <?php } ?>
                        </div>                
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
