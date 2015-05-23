<?php

namespace net\frenzel\communication\models;

use yii\base\Event;
use yii\helpers\ArrayHelper;
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

class Communication extends \yii\db\ActiveRecord
{
    const TYPE_CALL = 1;
    const TYPE_MAIL = 2;
    const TYPE_SMS = 3;
    const TYPE_FAX = 5;
    const TYPE_IM = 7;
    
    public static $communicationTypes = [
        self::TYPE_CALL => 'Phone',
        self::TYPE_MAIL => 'Mail',
        self::TYPE_SMS => 'Mobile',
        self::TYPE_FAX => 'Fax',
        self::TYPE_IM => 'IM'
    ];

    public static $communicationTypesIcons = [
        self::TYPE_CALL => 'phone-square',
        self::TYPE_MAIL => 'send',
        self::TYPE_SMS => 'mobile',
        self::TYPE_FAX => 'fax',
        self::TYPE_IM => 'skype'
    ];

    public static function getTypeArray()
    {
        return self::$communicationTypes;
    }
    
    public function getTypeAsString()
    {
        if(isset(self::$communicationTypes[$this->type]))
            return self::$communicationTypes[$this->type];
        return 'finished!';
    }

    public function getTypeAsIcon()
    {
        if(isset(self::$communicationTypesIcons[$this->type]))
            return self::$communicationTypesIcons[$this->type];
        return 'asterisk';
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%net_frenzel_communication}}';
    }

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
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'create' => ['type', 'entity', 'entity_id', 'text'],
            'update' => ['type' ,'text'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text','entity'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at','deleted_at','entity_id','type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => \Yii::t('app', 'ID'),
            'text'       => \Yii::t('app', 'Text'),
            'entity'     => \Yii::t('app', 'Entity'),
            'type'       => \Yii::t('app', 'Type'),
            'created_by' => \Yii::t('app', 'Created by'),
            'updated_by' => \Yii::t('app', 'Updated by'),
            'created_at' => \Yii::t('app', 'Created at'),
            'updated_at' => \Yii::t('app', 'Updated at'),
            'deleted_at' => \Yii::t('app', 'Updated at'),
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
            if ($model::find()->where(['id' => $this->model_id]) === false) {
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
}
