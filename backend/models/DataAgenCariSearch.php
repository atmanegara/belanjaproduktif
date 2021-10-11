<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataAgenCari;

/**
 * DataAgenSearch represents the model behind the search form of `backend\models\DataAgen`.
 */
class DataAgenCariSearch extends DataAgenCari
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen', 'id_ref_status_sipil'], 'integer'],
            [['id_agen','nama_agen', 'nik','no_acak_ref'], 'safe'],
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
        $query = DataAgen::find();//->innerJoin('registrasi_agen','data_agen.no_acak=registrasi_agen.no_acak')->orderBy('registrasi_agen.tgl_registrasi DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>10
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
       
 $query->andFilterWhere([
            'no_acak_ref' => $this->no_acak_ref,
        ]);
          
//$query->andWhere('(isnull(no_acak_ref) or no_acak_ref="")');
        return $dataProvider;
    }
}
