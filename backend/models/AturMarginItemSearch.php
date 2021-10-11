<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AturMarginItem;

/**
 * AturMarginItemSearch represents the model behind the search form of `backend\models\AturMarginItem`.
 */
class AturMarginItemSearch extends AturMarginItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
         //   [['id'], 'integer'],
            [['id_ref_barang'], 'safe'],
       //     [['nilai'], 'number'],
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
        $query = AturMarginItem::find();

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
            'id_ref_barang' => $this->id_ref_barang,
       //     'nilai' => $this->nilai,
        ]);

       // $query->andFilterWhere(['like', 'id_ref_barang', $this->id_ref_barang]);

        return $dataProvider;
    }
}
