<?php

namespace frenzelgmbh\cmcommunication\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frenzelgmbh\cmcommunication\models\Communication;

/**
 * CommunicationSearch represents the model behind the search form about `app\models\Communication`.
 */
class CommunicationSearch extends Communication
{
    public function rules()
    {
        return [
            [['id', 'user_id', 'mod_id', 'system_upate', 'created_at', 'updated_at', 'deleted_at', 'communication_type_id'], 'integer'],
            [['mobile', 'phone', 'fax', 'email', 'mod_table', 'system_key', 'system_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Communication::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'mod_id' => $this->mod_id,
            'system_upate' => $this->system_upate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'communication_type_id' => $this->communication_type_id,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mod_table', $this->mod_table])
            ->andFilterWhere(['like', 'system_key', $this->system_key])
            ->andFilterWhere(['like', 'system_name', $this->system_name]);

        return $dataProvider;
    }
}
