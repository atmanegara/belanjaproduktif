<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RiwayatBagiKomisi;

/**
 * RiwayatBagiKomisiSearch represents the model behind the search form of `backend\models\RiwayatBagiKomisi`.
 */
class RiwayatBagiKomisiSearch extends RiwayatBagiKomisi
{
   // public $nama_agen;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_data_agen'], 'integer'],
            [['tgl_dibagi', 'keterangan', 'tgljam_input'], 'safe'],
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
        $query = RiwayatBagiKomisi::find();

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
            'id_user' => $this->id_user,
            'id_data_agen' => $this->id_data_agen,
            'tgl_dibagi' => $this->tgl_dibagi,
            'nominal' => $this->nominal,
            'tgljam_input' => $this->tgljam_input,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
