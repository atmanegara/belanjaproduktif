<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataToko;

/**
 * DataTokoSearch represents the model behind the search form of `backend\models\DataToko`.
 */
class DataTokoSearch extends DataToko
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data_agen'], 'integer'],
            [['no_toko', 'alamat', 'id_kabupaten', 'id_kelurahan', 'id_kecamatan', 'telp', 'aktif'], 'safe'],
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
        $query = DataToko::find();

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

        $query->andFilterWhere(['like', 'no_toko', $this->no_toko])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'id_kabupaten', $this->id_kabupaten])
            ->andFilterWhere(['like', 'id_kelurahan', $this->id_kelurahan])
            ->andFilterWhere(['like', 'id_kecamatan', $this->id_kecamatan])
            ->andFilterWhere(['like', 'telp', $this->telp])
            ->andFilterWhere(['like', 'aktif', $this->aktif]);

        return $dataProvider;
    }
}
