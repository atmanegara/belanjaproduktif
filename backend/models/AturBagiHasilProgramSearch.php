<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AturBagiHasilProgram;

/**
 * AturBagiHasilProgramSearch represents the model behind the search form of `backend\models\AturBagiHasilProgram`.
 */
class AturBagiHasilProgramSearch extends AturBagiHasilProgram
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen', 'id_ref_program_agen'], 'integer'],
            [['nominal'], 'number'],
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
        $query = AturBagiHasilProgram::find();

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
            'id_ref_program_agen' => $this->id_ref_program_agen,
            'nominal' => $this->nominal,
        ]);

        return $dataProvider;
    }
}
