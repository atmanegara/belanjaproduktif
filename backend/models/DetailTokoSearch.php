<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DetailToko;

/**
 * DetailTokoSearch represents the model behind the search form of `backend\models\DetailToko`.
 */
class DetailTokoSearch extends DetailToko
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data_toko', 'hari'], 'integer'],
            [['jam_awal', 'jam_akhir', 'aktif', 'ket'], 'safe'],
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
        $query = DetailToko::find();

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
            'id_data_toko' => $this->id_data_toko,
            'hari' => $this->hari,
            'jam_awal' => $this->jam_awal,
            'jam_akhir' => $this->jam_akhir,
        ]);

        $query->andFilterWhere(['like', 'aktif', $this->aktif])
            ->andFilterWhere(['like', 'ket', $this->ket]);

        return $dataProvider;
    }
}
