<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BookingBarang;

/**
 * BookingBarangSearch represents the model behind the search form of `backend\models\BookingBarang`.
 */
class BookingBarangSearch extends BookingBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_stok_barang', 'qty_keluar', 'status_booking'], 'integer'],
            [['kd_booking', 'no_invoice', 'no_acak', 'tgl_batas_book', 'jam_batas_book'], 'safe'],
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
        $query = BookingBarang::find();

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
            'id_stok_barang' => $this->id_stok_barang,
            'qty_keluar' => $this->qty_keluar,
            'tgl_batas_book' => $this->tgl_batas_book,
            'status_booking' => $this->status_booking,
        ]);

        $query->andFilterWhere(['like', 'kd_booking', $this->kd_booking])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'jam_batas_book', $this->jam_batas_book]);

        return $dataProvider;
    }
}
