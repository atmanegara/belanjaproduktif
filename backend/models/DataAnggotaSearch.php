<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataAnggota;

/**
 * DataAnggotaSearch represents the model behind the search form of `backend\models\DataAnggota`.
 */
class DataAnggotaSearch extends DataAnggota
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen'], 'integer'],
            [['no_acak', 'no_acak_agen', 'nama_agen', 'nik'], 'safe'],
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
        $query =  DataAnggota::find()->innerJoin('registrasi_agen','data_anggota.no_acak=registrasi_agen.no_acak')->orderBy('registrasi_agen.tgl_registrasi DESC');

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
            'id_ref_agen' => $this->id_ref_agen,
        ]);

        $query->andFilterWhere(['like', 'no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'no_acak_agen', $this->no_acak_agen])
            ->andFilterWhere(['like', 'nama_agen', $this->nama_agen])
            ->andFilterWhere(['like', 'nik', $this->nik]);

        return $dataProvider;
    }
}
