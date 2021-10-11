<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TutupBuku;

/**
 * TutupBukuSearch represents the model behind the search form of `backend\models\TutupBuku`.
 */
class TutupBukuSearch extends TutupBuku
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kd_posting', 'user_id'], 'integer'],
            [['no_acak', 'tahun_posting', 'no_acak_user'], 'safe'],
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
        $query = TutupBuku::find()->orderBy('tgljam_lapor DESC');

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
            'kd_posting' => $this->kd_posting,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'no_acak', $this->no_acak])
             ->andFilterWhere(['like', 'no_acak_user', $this->no_acak_user]);

        return $dataProvider;
    }
}
