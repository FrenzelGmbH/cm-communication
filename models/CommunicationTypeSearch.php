<?php

namespace frenzelgmbh\cmcommunication\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frenzelgmbh\cmcommunication\models\CommunicationType;

/**
 * CommunicationTypeSearch represents the model behind the search form about `app\models\CommunicationType`.
 */
class CommunicationTypeSearch extends CommunicationType
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'system_upate', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name', 'system_key', 'system_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = CommunicationType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'system_upate' => $this->system_upate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'system_key', $this->system_key])
            ->andFilterWhere(['like', 'system_name', $this->system_name]);

        return $dataProvider;
    }
}
