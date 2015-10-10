<?php

namespace net\frenzel\communication\models\base;

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

class BaseCommunication extends \yii\db\ActiveRecord
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
}
