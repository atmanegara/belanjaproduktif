<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataItemBarangAgen;

/**
 * DataItemBarangAgenSearch represents the model behind the search form of `backend\models\DataItemBarangAgen`.
 */
class DaftarKepemilikanSearch extends DataItemBarangAgen
{
    public $id_agen,$item_barang,$nama_agen;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_barang','nama_agen'], 'safe'],
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
            $no_acak = \Yii::$app->user->identity->no_acak;
         $sqlQuery =(new \yii\db\Query())
                    ->select('c.*,f.nama_agen,f.id_agen')
                    ->from('data_item_barang_agen c')
                 ->innerJoin('data_toko cc','c.id_data_toko=cc.id')
                    ->innerJoin('data_agen e','e.id=cc.id_data_agen')
                 ->innerJoin('data_agen f','c.no_acak=f.no_acak')
                    ->where([
                        'e.no_acak'=>$no_acak
                    ]);

 $query = (new \yii\db\Query())
         ->select('b.item_barang,a.no_acak,a.nama_agen,a.id_agen')
         ->from(['a'=>$sqlQuery])
         ->rightJoin('data_barang b','b.id=a.id_data_barang')
         ->rightJoin('data_agen c','b.id_data_agen=c.id')
         ->where([
             'c.no_acak'=>$no_acak
         ])->orderBy('a.no_acak desc');
 $dataProvider = new \yii\data\ActiveDataProvider([
     'query'=>$query
 ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->nama_agen,
//            'id_ref_barang' => $this->id_ref_barang,
//            'tgl_masuk' => $this->tgl_masuk,
//        ]);

        $query->andFilterWhere(['like', 'b.item_barang', $this->item_barang]);
        $query->andFilterWhere(['like', 'a.nama_agen', $this->nama_agen]);

        return $dataProvider;
    }
}
