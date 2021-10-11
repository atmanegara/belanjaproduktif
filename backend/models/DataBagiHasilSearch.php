<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataBagiHasil;

/**
 * DataBagiHasilSearch represents the model behind the search form of `backend\models\DataBagiHasil`.
 */
class DataBagiHasilSearch extends DataBagiHasil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen', 'persen', 'hasil'], 'integer'],
            [['no_acak', 'no_acak_tutup_buku', 'tgl_masuk'], 'safe'],
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
        $query = DataBagiHasil::find();

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
            'id_ref_agen' => $this->id_ref_agen,
            'persen' => $this->persen,
            'hasil' => $this->hasil,
        ]);

        $query->andFilterWhere(['like', 'no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'no_acak_tutup_buku', $this->no_acak_tutup_buku])
            ->andFilterWhere(['like', 'tgl_masuk', $this->tgl_masuk]);

        return $dataProvider;
    }
}
