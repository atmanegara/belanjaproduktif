<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RefAgen;

/**
 * RefAgenSearch represents the model behind the search form of `backend\models\RefAgen`.
 */
class RefAgenSearch extends RefAgen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',], 'integer'],
            [['kd_agen', 'nama_agen'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RefAgen::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
       //     'id_ref_syarat_agen' => $this->id_ref_syarat_agen,
        ]);

        $query->andFilterWhere(['like', 'kd_agen', $this->kd_agen])
            ->andFilterWhere(['like', 'nama_agen', $this->nama_agen]);

        return $dataProvider;
    }
}
