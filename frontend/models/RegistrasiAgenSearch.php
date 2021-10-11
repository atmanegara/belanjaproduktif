<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RegistrasiAgen;

/**
 * RegistrasiAgenSearch represents the model behind the search form of `frontend\models\RegistrasiAgen`.
 */
class RegistrasiAgenSearch extends RegistrasiAgen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_kelurahan', 'id_ref_kecamatan', 'id_ref_agen', 'id_ref_proses_pendaftaran'], 'integer'],
            [['no_reg', 'nik', 'nama', 'alamat', 'rt_rw', 'nope'], 'safe'],
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
        $query = RegistrasiAgen::find();

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
            'id_ref_kelurahan' => $this->id_ref_kelurahan,
            'id_ref_kecamatan' => $this->id_ref_kecamatan,
            'id_ref_agen' => $this->id_ref_agen,
            'id_ref_proses_pendaftaran' => $this->id_ref_proses_pendaftaran,
        ]);

        $query->andFilterWhere(['like', 'no_reg', $this->no_reg])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt_rw', $this->rt_rw])
            ->andFilterWhere(['like', 'nope', $this->nope]);

        return $dataProvider;
    }
}
