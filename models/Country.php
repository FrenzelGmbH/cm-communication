<?php

namespace frenzelgmbh\cmcommunication\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $iso2
 * @property string $iso3
 * @property string $name
 *
 * @property Address[] $addresses
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso2'], 'string', 'max' => 2],
            [['iso3'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => Yii::t('cm-communication', 'ID'),
            'iso2' => Yii::t('cm-communication', 'Iso2'),
            'iso3' => Yii::t('cm-communication', 'Iso3'),
            'name' => Yii::t('cm-communication', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['country_id' => 'id']);
    }
}
