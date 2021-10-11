<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StokGudang;

/**
 * StokGudangSearch represents the model behind the search form of `backend\models\StokGudang`.
 */
class StokGudangSearch extends StokGudang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_gudang', 'id_ref_barang', 'qty'], 'integer'],
            [['harga_satuan', 'harga_jual'], 'number'],
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
        $query = StokGudang::find();

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
            'id_ref_gudang' => $this->id_ref_gudang,
            'id_ref_barang' => $this->id_ref_barang,
            'qty' => $this->qty,
            'harga_satuan' => $this->harga_satuan,
            'harga_jual' => $this->harga_jual,
        ]);

        return $dataProvider;
    }
}
