<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form of `backend\models\User`.
 */
class UserSearch extends User
{
    public $nik;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'role_id',  'status', 'created_at', 'updated_at'], 'integer'],
            [['no_acak','nik', 'id_agen', 'username', 'auth_key', 'password_string', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'safe'],
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
        $query = (new \yii\db\Query())
                ->select('a.id,a.no_acak,b.nik,a.username,a.password_string,a.id_ref_agen')
                ->from('user a')
                ->innerJoin('registrasi_agen b','a.no_acak=b.no_acak');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key'=>'id',
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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'role_id' => $this->role_id,
//            'id_ref_agen' => $this->id_ref_agen,
//            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at,
//        ]);

        $query->andFilterWhere(['like', 'a.no_acak', $this->no_acak])
            ->andFilterWhere(['like', 'b.nik', $this->nik])
            ->andFilterWhere(['like', 'a.username', $this->username]);
//            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
//            ->andFilterWhere(['like', 'password_string', $this->password_string])
//            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
//            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
//            ->andFilterWhere(['like', 'email', $this->email])
//            ->andFilterWhere(['like', 'verification_token', $this->verification_token]);

        return $dataProvider;
    }
}
