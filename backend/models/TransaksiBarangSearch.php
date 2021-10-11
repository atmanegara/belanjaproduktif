<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransaksiBarang;

/**
 * TransaksiBarangSearch represents the model behind the search form of `backend\models\TransaksiBarang`.
 */
class TransaksiBarangSearch extends TransaksiBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_data_agen', 'id_data_barang', 'qty'], 'integer'],
            [['tgl_transaksi', 'keterangan'], 'safe'],
            [['harga_satuan'], 'number'],
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
        $query = TransaksiBarang::find();

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
            'tgl_transaksi' => $this->tgl_transaksi,
            'id_data_agen' => $this->id_data_agen,
            'id_data_barang' => $this->id_data_barang,
            'qty' => $this->qty,
            'harga_satuan' => $this->harga_satuan,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
