<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RegistrasiAgen;

/**
 * RegistrasiAgenSearch represents the model behind the search form of `backend\models\RegistrasiAgen`.
 */
class RegistrasiAgenSearch extends RegistrasiAgen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen', 'id_ref_proses_pendaftaran'], 'integer'],
            [['no_reg', 'no_acak', 'nik', 'nama', 'id_kelurahan', 'id_kecamatan', 'alamat', 'rt_rw', 'nope', 'email', 'setuju'], 'safe'],
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
        $query = RegistrasiAgen::find()
                ->select('a.*,b.nama_agen')
                ->alias('a')
                ->leftJoin('data_agen b','a.no_acak=b.no_acak')
                ->orderBy('tgl_registrasi DESC');
            
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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_kelurahan' => $this->id_kelurahan,
//            'id_kecamatan' => $this->id_kecamatan,
//            'id_ref_agen' => $this->id_ref_agen,
//            'id_ref_proses_pendaftaran' => $this->id_ref_proses_pendaftaran,
//        ]);

        $query->andFilterWhere(['like', 'a.no_reg', $this->no_reg])
            ->andFilterWhere(['like', 'a.no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'a.nik', $this->nik])
            ->andFilterWhere(['like', 'b.nama_agen', $this->nama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'rt_rw', $this->rt_rw])
            ->andFilterWhere(['like', 'nope', $this->nope])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'setuju', $this->setuju]);

        return $dataProvider;
    }
}
