<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_kurir".
 *
 * @property int $id
 * @property int $id_ref_kurir
 * @property string|null $nik
 * @property string|null $nama_kurir
 * @property string|null $telp_kurir
 */
class DataKurir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_kurir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_kurir'], 'integer'],
            [['nik', 'nama_kurir', 'telp_kurir'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_kurir' => 'MITRA KURIR',
            'nik' => 'NIK / NO. ANGGOTA',
            'nama_kurir' => 'NAMA',
            'telp_kurir' => 'TELPON',
        ];
    }
    
    public static function dropDownKurir(){
        $array = DataKurir::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', function($model, $defaultValue){
            $modelRefKurir = RefKurir::find()->where(['id'=>$model['id_ref_kurir']])->one();
                 return $modelRefKurir['nama_kurir'].'( '.$model['nik'].': '.$model['nama_kurir'].', Telp : '.$model['telp_kurir'].' )';
        });
    }
       public static function dropDownKurirByKurir($id_ref_kurir){
        $array = DataKurir::find()->where(['id_ref_kurir'=>$id_ref_kurir])->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', function($model, $defaultValue){
            $modelRefKurir = RefKurir::find()->where(['id'=>$model['id_ref_kurir']])->one();
            return $modelRefKurir['nama_kurir'].'( '.$model['nik'].': '.$model['nama_kurir'].', Telp : '.$model['telp_kurir'].' )';
        });
    }
}
