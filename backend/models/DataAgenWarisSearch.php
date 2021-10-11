<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataAgenWaris;

/**
 * DataAgenWarisSearch represents the model behind the search form of `backend\models\DataAgenWaris`.
 */
class DataAgenWarisSearch extends DataAgenWaris
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data_agen'], 'integer'],
            [['nama_waris', 'nope_waris', 'jns_bank', 'atas_nama_bank', 'norek_bank'], 'safe'],
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
        $query = DataAgenWaris::find();

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
            'id_data_agen' => $this->id_data_agen,
        ]);

        $query->andFilterWhere(['like', 'nama_waris', $this->nama_waris])
            ->andFilterWhere(['like', 'nope_waris', $this->nope_waris])
            ->andFilterWhere(['like', 'jns_bank', $this->jns_bank])
            ->andFilterWhere(['like', 'atas_nama_bank', $this->atas_nama_bank])
            ->andFilterWhere(['like', 'norek_bank', $this->norek_bank]);

        return $dataProvider;
    }
}
