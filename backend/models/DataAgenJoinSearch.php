<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataAgen;

/**
 * DataAgenSearch represents the model behind the search form of `backend\models\DataAgen`.
 */
class DataAgenJoinSearch extends DataAgen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen', 'id_ref_status_sipil'], 'integer'],
            [['id_agen','id_kab', 'id_kelurahan', 'id_kecamatan', 'id_kecamatan_domisili','id_kab_domisili', 'id_kelurahan_domisili', 'nama_agen', 'nik', 'alamat', 'rt', 'rw', 'kode_post', 'tmpt_lahir', 'tgl_lahir', 'pekerjaan', 'no_wa', 'alamat_domisili', 'rt_domisili', 'rw_domisili'], 'safe'],
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
        $query = DataAgen::find()->where(['IN','id_ref_agen',['2','3','4','6','7']])
                ->andWhere('(isnull(no_acak_ref) or no_acak_ref="")')
                ->orWhere(['no_acak_ref'=>\Yii::$app->user->identity->no_acak]);

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
//            'id_ref_agen' => $this->id_ref_agen,
//            'id_kelurahan' => $this->id_kelurahan,
//            'id_kecamatan' => $this->id_kecamatan,
//            'tgl_lahir' => $this->tgl_lahir,
//            'id_ref_status_sipil' => $this->id_ref_status_sipil,
//            'id_kecamatan_domisili' => $this->id_kecamatan_domisili,
//        ]);

        $query->andFilterWhere(['like', 'id_agen', $this->id_agen])
            ->andFilterWhere(['like', 'nama_agen', $this->nama_agen])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'alamat', $this->alamat]);

        return $dataProvider;
    }
}