<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StokBarang;

/**
 * StokBarangSearch represents the model behind the search form of `backend\models\StokBarang`.
 */
class StokBarangSearch extends StokBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data_agen', 'id_data_barang', 'stok_awal', 'stok_masuk', 'stok_keluar'], 'integer'],
            [['tgl_masuk'], 'safe'],
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
        $query = StokBarang::find();

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
            'tgl_masuk' => $this->tgl_masuk,
            'id_data_agen' => $this->id_data_agen,
            'id_data_barang' => $this->id_data_barang,
            'stok_awal' => $this->stok_awal,
            'stok_masuk' => $this->stok_masuk,
            'stok_keluar' => $this->stok_keluar,
        ]);

        return $dataProvider;
    }
}
