<?php

namespace net\frenzel\communication\models;

use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use net\frenzel\communication\models\scopes\CommunicationQuery;

/**
 * @author Philipp Frenzel <philipp@frenzel.net> 
 */

/**
 * This is the model class for table "communication".
 * @package net\frenzel\communication\models
 *
 * @property integer $id
 * @property string $entity
 * @property integer $entity_id
 * @property integer $type
 * @property string $text
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CommunicationType $communicationType
 */

class Communication extends \net\frenzel\communication\models\base\BaseCommunication
{
    /**
     * @inheritdoc
     * @return MandantenQuery
     */
    public static function find()
    {
        return new CommunicationQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\BlameableBehavior::className(),
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        $Module = \Yii::$app->getModule('communication');
        return $this->hasOne($Module->userIdentityClass, ['id' => 'created_by']);
    }

    /**
     * Delete communication
     *
     * @return boolean communication was deleted or not
     */
    public function deleteCommunication()
    {
        $this->touch('deleted_at');
        return $this->save(false, ['deleted_at']);
    }

    /**
     * [getCommunications description]
     * @param  [type] $model [description]
     * @param  [type] $class [description]
     * @return [type]        [description]
     */
    public static function getCommunications($model, $class)
    {
        $models = self::find()->where([
            'entity_id' => $model,
            'entity' => $class
        ])->orderBy('{{%net_frenzel_communication}}.created_at DESC')->active()->with(['author'])->all();
        
        return $models;
    }

    /**
     * Model ID validation.
     *
     * @param string $attribute Attribute name
     * @param array $params Attribute params
     *
     * @return mixed
     */
    public function validateModelId($attribute, $params)
    {
        /** @var ActiveRecord $class */
        $class = Model::findIdentity($this->model_class);
        if ($class === null) {
            $this->addError($attribute, \Yii::t('net_frenzel_communication', 'ERROR_MSG_INVALID_MODEL_ID'));
        } else {
            $model = $class->name;
            if ($model::find()->where(['id' => $this->entity_id]) === false) {
                $this->addError($attribute, \Yii::t('net_frenzel_communication', 'ERROR_MSG_INVALID_MODEL_ID'));
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Model::className(), ['id' => 'entity']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        /** @var ActiveRecord $class */
        $class = Model::find()->where(['id' => $this->entity])->asArray()->one();
        $model = $class->name;
        return $this->hasOne($model::className(), ['id' => 'entity_id']);
    }

    /**
     * [getTextAsLink description]
     * @return [type] [description]
     */
    public function getTextAsLink()
    {
        $html = '';
        if($this->type == self::TYPE_CALL)
        {
            $html .= Html::a($this->text,'tel:'.$this->text,['target' => '_blank']);
        }
        else
        {
            $html .= $this->text;
        }
        return $html;
    }
}
