<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TentangKami;

/**
 * TentangKamiSearch represents the model behind the search form of `backend\models\TentangKami`.
 */
class TentangKamiSearch extends TentangKami
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alamat_cv'], 'integer'],
            [['nama_cv', 'no_siup', 'telp_cv', 'kontak_lainnya'], 'safe'],
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
        $query = TentangKami::find();

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
            'alamat_cv' => $this->alamat_cv,
        ]);

        $query->andFilterWhere(['like', 'nama_cv', $this->nama_cv])
            ->andFilterWhere(['like', 'no_siup', $this->no_siup])
            ->andFilterWhere(['like', 'telp_cv', $this->telp_cv])
            ->andFilterWhere(['like', 'kontak_lainnya', $this->kontak_lainnya]);

        return $dataProvider;
    }
}
