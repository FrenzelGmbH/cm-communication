<?php

namespace frenzelgmbh\cmcommunication\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "communication".
 *
 * @property integer $id
 * @property string $mobile
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property integer $user_id
 * @property string $mod_table
 * @property integer $mod_id
 * @property string $system_key
 * @property string $system_name
 * @property integer $system_upate
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $communication_type_id
 *
 * @property CommunicationType $communicationType
 */
class Communication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%communication}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'mod_id', 'system_upate', 'created_at', 'updated_at', 'deleted_at', 'communication_type_id'], 'integer'],
            [['mobile', 'phone', 'fax', 'email'], 'string', 'max' => 200],
            [['mod_table', 'system_key', 'system_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                    => Yii::t('cm-communication', 'ID'),
            'mobile'                => Yii::t('cm-communication', 'Mobile'),
            'phone'                 => Yii::t('cm-communication', 'Phone'),
            'fax'                   => Yii::t('cm-communication', 'Fax'),
            'email'                 => Yii::t('cm-communication', 'Email'),
            'user_id'               => Yii::t('cm-communication', 'User ID'),
            'mod_table'             => Yii::t('cm-communication', 'Mod Table'),
            'mod_id'                => Yii::t('cm-communication', 'Mod ID'),
            'system_key'            => Yii::t('cm-communication', 'System Key'),
            'system_name'           => Yii::t('cm-communication', 'System Name'),
            'system_upate'          => Yii::t('cm-communication', 'System Upate'),
            'created_at'            => Yii::t('cm-communication', 'Created At'),
            'updated_at'            => Yii::t('cm-communication', 'Updated At'),
            'deleted_at'            => Yii::t('cm-communication', 'Deleted At'),
            'communication_type_id' => Yii::t('cm-communication', 'Communication Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunicationType()
    {
        return $this->hasOne(CommunicationType::className(), ['id' => 'communication_type_id']);
    }
}
