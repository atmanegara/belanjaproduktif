<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataBarangKeluar;

/**
 * DataBarangKeluarSearch represents the model behind the search form of `backend\models\DataBarangKeluar`.
 */
class DataBarangKeluarSearch extends DataBarangKeluar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data_barang', 'qty'], 'integer'],
            [['harga'], 'number'],
            [['tgl_keluar', 'tgl_input'], 'safe'],
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
        $query = DataBarangKeluar::find();

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
            'id_data_barang' => $this->id_data_barang,
            'qty' => $this->qty,
            'harga' => $this->harga,
            'tgl_keluar' => $this->tgl_keluar,
            'tgl_input' => $this->tgl_input,
        ]);

        return $dataProvider;
    }
}
