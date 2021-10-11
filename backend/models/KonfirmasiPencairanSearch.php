<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KonfirmasiPencairan;

/**
 * KonfirmasiPencairanSearch represents the model behind the search form of `backend\models\KonfirmasiPencairan`.
 */
class KonfirmasiPencairanSearch extends KonfirmasiPencairan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_metode_transfer', 'id_data_agen', 'id_status_pembayaran'], 'integer'],
            [['no_acak', 'no_invoice', 'from_bank', 'tgl_ajukan', 'jamtgl'], 'safe'],
            [['nominal'], 'number'],
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
        $query = KonfirmasiPencairan::find()->orderBy('jamtgl DESC');

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
            'tgl_ajukan' => $this->tgl_ajukan,
            'id_data_agen' => $this->id_data_agen,
            'nominal' => $this->nominal,
            'id_status_pembayaran' => $this->id_status_pembayaran,
            'jamtgl' => $this->jamtgl,
        ]);

        $query->andFilterWhere(['like', 'no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'no_invoice', $this->no_invoice])
            ->andFilterWhere(['like', 'from_bank', $this->from_bank]);

        return $dataProvider;
    }
}
