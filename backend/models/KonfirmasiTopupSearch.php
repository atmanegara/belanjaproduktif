<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KonfirmasiTopup;

/**
 * KonfirmasiTopupSearch represents the model behind the search form of `backend\models\KonfirmasiTopup`.
 */
class KonfirmasiTopupSearch extends KonfirmasiTopup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_metode_transfer','id_ket_saldo', 'nominal', 'id_status_pembayaran'], 'integer'],
            [['no_acak', 'no_invoice', 'from_bank', 'tgl_transfer', 'filename'], 'safe'],
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
        $query = KonfirmasiTopup::find()->innerJoin('data_agen','konfirmasi_topup.no_acak=data_agen.no_acak');

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
            'id_ket_saldo'=>$this->id_ket_saldo,
            'id_metode_transfer' => $this->id_metode_transfer,
            'nominal' => $this->nominal,
            'tgl_transfer' => $this->tgl_transfer,
            'id_status_pembayaran' => $this->id_status_pembayaran,
        ]);

        $query->andFilterWhere(['like', 'konfirmasi_topup.no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'from_bank', $this->from_bank])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }
}
