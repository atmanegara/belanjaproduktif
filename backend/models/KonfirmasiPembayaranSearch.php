<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KonfirmasiPembayaran;

/**
 * KonfirmasiPembayaranSearch represents the model behind the search form of `backend\models\KonfirmasiPembayaran`.
 */
class KonfirmasiPembayaranSearch extends KonfirmasiPembayaran
{
//    public $nik;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nominal', 'id_status_pembayaran'], 'integer'],
            [['no_acak','no_invoice', 'tgl_transfer','nik'], 'safe'],
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
     
//          $query = KonfirmasiPembayaran::find()
//                ->alias('a')
//                ->where(['NOT IN','a.no_acak',(new \yii\db\Query())->select('no_acak')->from('data_agen')])->orderBy('tgl_transfer desc');
        $query = KonfirmasiPembayaran::find()
                ->alias('a')
                ->select('a.*,b.nik')
                ->leftJoin('registrasi_agen b','a.no_acak=b.no_acak')
                ->orderBy('tgl_transfer desc');

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
            'a.id' => $this->id,
            'a.nominal' => $this->nominal,
            'a.tgl_transfer' => $this->tgl_transfer,
            'a.id_status_pembayaran' => $this->id_status_pembayaran,
            'a.no_invoice'=>$this->no_invoice
        ]);

        $query->andFilterWhere(['like', 'a.no_acak', $this->no_acak])
                ->andFilterWhere(['LIKE','b.nik',$this->nik]);

        return $dataProvider;
    }
}
