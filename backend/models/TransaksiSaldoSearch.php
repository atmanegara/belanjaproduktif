<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TransaksiSaldo;

/**
 * TransaksiSaldoSearch represents the model behind the search form of `backend\models\TransaksiSaldo`.
 */
class TransaksiSaldoSearch extends TransaksiSaldo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_metode_transfer', 'id_ref_bank'], 'integer'],
            [['tgl_transaksi', 'no_acak'], 'safe'],
            [['nominal_masuk'], 'number'],
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
        $query = TransaksiSaldo::find();

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
            'nominal_masuk' => $this->nominal_masuk,
            'id_metode_transfer' => $this->id_metode_transfer,
            'id_ref_bank' => $this->id_ref_bank,
        ]);

        $query->andFilterWhere(['like', 'no_acak', $this->no_acak]);

        return $dataProvider;
    }
}
