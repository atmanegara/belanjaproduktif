<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataBarang;

/**
 * DataBarangSearch represents the model behind the search form of `backend\models\DataBarang`.
 */
class DataListBarangSearch extends DataBarang
{
    public $stok;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', ], 'integer'],
            [['item_barang','kode_barcode','stok'], 'safe'],
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
        $query = DataBarang::find();//->select('count(id_data_agen) bykagen,item_barang,id_ref_barang')->groupBy('id_ref_barang');
       if($this->stok=='0'){
             $query->innerJoin('stok_barang','data_barang.id=stok_barang.id_data_barang');
            $query->andWhere(['<=', 'stok_barang.stok_sisa',$this->stok]);
       };
        $query->andWhere(['data_barang.aktif'=>'Y']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key'=>'id_ref_barang'
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'data_barang.id_data_agen' => $this->id_data_agen,
            'data_barang.kode_barcode' => $this->kode_barcode,
        ]);

        $query->andFilterWhere(['like', 'data_barang.item_barang', $this->item_barang]);

        return $dataProvider;
    }
}
