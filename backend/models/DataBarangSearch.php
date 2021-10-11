<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataBarang;

/**
 * DataBarangSearch represents the model behind the search form of `backend\models\DataBarang`.
 */
class DataBarangSearch extends DataBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', ], 'integer'],
            [['item_barang','kode_barcode','barkode'], 'safe'],
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
        $query = DataBarang::find()->select('count(id_data_agen) bykagen,kode_barcode,item_barang,id_ref_barang')->groupBy('id_ref_barang');

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
            'id' => $this->id,
            'id_data_agen' => $this->id_data_agen,
            'barkode' => $this->barkode,
            'kode_barcode' => $this->kode_barcode,
        ]);

        $query->andFilterWhere(['like', 'item_barang', $this->item_barang]);

        return $dataProvider;
    }
}
