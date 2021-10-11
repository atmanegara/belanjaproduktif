<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CatatanBarang;

/**
 * CatatanBarangSearch represents the model behind the search form of `backend\models\CatatanBarang`.
 */
class CatatanBarangSearch extends CatatanBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_barang', 'id_ref_satuan', 'qty', 'id_data_agen', 'id_ref_suplier'], 'integer'],
            [['tgl_pemesanan'], 'safe'],
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
        $query = CatatanBarang::find()->select(['count(id_ref_barang) as jumlah,id_data_agen,no_acak,tgl_pemesanan'])->groupBy('id_data_agen,tgl_pemesanan,no_acak');

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
            'id_ref_barang' => $this->id_ref_barang,
            'id_ref_satuan' => $this->id_ref_satuan,
            'qty' => $this->qty,
            'id_data_agen' => $this->id_data_agen,
            'id_ref_suplier' => $this->id_ref_suplier,
            'tgl_pemesanan' => $this->tgl_pemesanan,
        ]);

        return $dataProvider;
    }
}
