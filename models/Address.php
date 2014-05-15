<?php

namespace frenzelgmbh\cmcommunication\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use frenzelgmbh\cmcommunication\components\GeoLocation;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $cityName
 * @property string $zipCode
 * @property string $postBox
 * @property string $addresslineOne
 * @property string $addresslineTwo
 * @property float $longitude
 * @property float $latitude
 * @property string $regionName
 * @property integer $user_id
 * @property string $mod_table
 * @property integer $mod_id
 * @property string $system_key
 * @property string $system_name
 * @property integer $system_upate
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $country_id
 *
 * @property Country $country
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
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
            [['user_id', 'mod_id', 'system_upate', 'created_at', 'updated_at', 'country_id'], 'integer'],
            // done by timestamp behaviour[['created_at', 'updated_at'], 'required'],
            [['cityName', 'addresslineOne', 'addresslineTwo', 'mod_table', 'system_key', 'system_name'], 'string', 'max' => 100],
            [['zipCode', 'postBox'], 'string', 'max' => 20],
            [['regionName'], 'string', 'max' => 50],
            [['latitude', 'longitude'],'string','max'=>20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => Yii::t('cm-communication', 'ID'),
            'cityName'       => Yii::t('cm-communication', 'City'),
            'zipCode'        => Yii::t('cm-communication', 'Zip Code'),
            'postBox'        => Yii::t('cm-communication', 'Post Box'),
            'addresslineOne' => Yii::t('cm-communication', 'Addressline One'),
            'addresslineTwo' => Yii::t('cm-communication', 'Addressline Two'),
            'longitude'      => Yii::t('cm-communication', 'Longitude'),
            'latitude'       => Yii::t('cm-communication', 'Latitude'),
            'regionName'     => Yii::t('cm-communication', 'Region'),
            'user_id'        => Yii::t('cm-communication', 'User'),
            'mod_table'      => Yii::t('cm-communication', 'Mod Table'),
            'mod_id'         => Yii::t('cm-communication', 'Mod ID'),
            'system_key'     => Yii::t('cm-communication', 'System Key'),
            'system_name'    => Yii::t('cm-communication', 'System Name'),
            'system_upate'   => Yii::t('cm-communication', 'System Upate'),
            'created_at'     => Yii::t('cm-communication', 'Created At'),
            'updated_at'     => Yii::t('cm-communication', 'Updated At'),
            'country_id'     => Yii::t('cm-communication', 'Country ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            //get the geo location information
        }
        //geolocating
        $location = $this->addresslineOne . ' ,' . $this->cityName;
        $response = GeoLocation::getGeocodeFromGoogle($location);
        if(array_key_exists(0, $response->results))
        {
            $this->latitude = $response->results[0]->geometry->location->lat;
            $this->longitude = $response->results[0]->geometry->location->lng;
        }
        
        return parent::beforeSave($insert);
    }

    public static function getIPLocation(){
        //initialize the browser
        $adapter = new \Geocoder\HttpAdapter\GuzzleHttpAdapter();
        
        //create geocoder
        $geocoder = new \Geocoder\Geocoder();
        $geocoder->registerProviders([
          new \Geocoder\Provider\FreeGeoIpProvider($adapter)
        ]);

        if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $client_ip = $_SERVER['REMOTE_ADDR'];
        }
        else {
          $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $geocoder->geocode($client_ip);
    }
}
