<?php

namespace frenzelgmbh\cmcommunication\models;

use Yii;

/**
 * This is the model class for table "communication_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property string $system_key
 * @property string $system_name
 * @property integer $system_upate
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property Communication[] $communications
 */
class CommunicationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%communication_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'system_upate', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['name', 'system_key', 'system_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('cm-communication', 'ID'),
            'name' => Yii::t('cm-communication', 'Name'),
            'user_id' => Yii::t('cm-communication', 'User ID'),
            'system_key' => Yii::t('cm-communication', 'System Key'),
            'system_name' => Yii::t('cm-communication', 'System Name'),
            'system_upate' => Yii::t('cm-communication', 'System Upate'),
            'created_at' => Yii::t('cm-communication', 'Created At'),
            'updated_at' => Yii::t('cm-communication', 'Updated At'),
            'deleted_at' => Yii::t('cm-communication', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunications()
    {
        return $this->hasMany(Communication::className(), ['communication_type_id' => 'id']);
    }
}
