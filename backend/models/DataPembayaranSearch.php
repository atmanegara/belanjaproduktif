<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataPembayaran;

/**
 * DataPembayaranSearch represents the model behind the search form of `backend\models\DataPembayaran`.
 */
class DataPembayaranSearch extends DataPembayaran
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_metode_transfer', 'nominal', 'id_status_pembayaran', 'id_status_dp'], 'integer'],
            [['no_acak', 'no_invoice', 'from_bank', 'tgl_transfer', 'tgl_konfirmasi', 'filename'], 'safe'],
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
        $query = DataPembayaran::find();

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
            'id_metode_transfer' => $this->id_metode_transfer,
            'nominal' => $this->nominal,
            'tgl_transfer' => $this->tgl_transfer,
            'tgl_konfirmasi' => $this->tgl_konfirmasi,
            'id_status_pembayaran' => $this->id_status_pembayaran,
            'id_status_dp' => $this->id_status_dp,
        ]);

        $query->andFilterWhere(['like', 'no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'from_bank', $this->from_bank])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }
}
