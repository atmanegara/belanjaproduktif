<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_saldo".
 *
 * @property int $id
 * @property string $no_acak
 * @property float|null $nominal_awal
 */
class DataSaldo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_saldo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nominal_awal'], 'number'],
            [['no_acak'], 'string', ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'nominal_awal' => 'Nominal Awal',
        ];
    }
    
    public static function nominaldulu($no_acak){
       $nominal=0;
        $array = DataSaldo::findOne(['no_acak'=>$no_acak]);
        if(!$array){
            $nominal = 0;
        }else{
            $nominal=$array['nominal_awal'];
        }
        return $nominal;
    }
    
    public static function getTotalNominal($no_acak){
        $dataSaldo = DataSaldo::find()->where(['no_acak'=>$no_acak])->one();
        return $dataSaldo;
    }
}
