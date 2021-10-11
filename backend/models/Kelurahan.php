<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kelurahan".
 *
 * @property string $id_kel
 * @property string|null $id_kec
 * @property string|null $nama
 * @property int $id_jenis
 */
class Kelurahan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelurahan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kel', 'id_jenis'], 'required'],
            [['nama'], 'string'],
            [['id_jenis'], 'integer'],
            [['id_kel'], 'string', 'max' => 10],
            [['id_kec'], 'string', 'max' => 6],
            [['id_kel'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kel' => 'Id Kel',
            'id_kec' => 'Id Kec',
            'nama' => 'Nama',
            'id_jenis' => 'Id Jenis',
        ];
    }
    
    public static function getKeluarahnByIdKec($id_kec){
        return Kelurahan::find()->where(['id_kec'=>$id_kec])->all();
    }
       public static function getDropdownkelurahanAll(){
           $array = Kelurahan::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array,'id_kel','nama');
    }
}
