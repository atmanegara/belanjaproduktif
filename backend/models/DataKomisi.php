<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_komisi".
 *
 * @property int $id
 * @property int|null $id_data_agen
 * @property string|null $tgl_transaksi
 * @property int|null $nominal
 * @property string|null $ket
 */
class DataKomisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_komisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_agen', 'nominal'], 'integer'],
            [['tgl_transaksi'], 'safe'],
            [['ket','no_acak'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_agen' => 'Agen',
            'tgl_transaksi' => 'Tgl Transaksi',
            'nominal' => 'Nominal',
            'ket' => 'Ket',
        ];
    }
    
    public static function getNominal($no_acak){
        $array = DataKomisi::find()->where(['no_acak'=>$no_acak]);
            $nominal = 0;
        
        if($array->exists()){
            $nominal = $array->one()->nominal;
        }
        return $nominal;
    }
    
    public static function sumAllKomisi($no_acak){
        $array = DataKomisi::find()->select("sum(nominal) nominal")->where(['no_acak'=>$no_acak])->one();
        return $array['nominal'];
    }
}
