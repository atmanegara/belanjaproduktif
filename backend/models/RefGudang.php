<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_gudang".
 *
 * @property int $id
 * @property string|null $nama_gudang
 * @property resource|null $alamat
 */
class RefGudang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_gudang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_gudang'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_gudang' => 'Nama Gudang',
            'alamat' => 'Alamat',
        ];
    }
    
    public static function dropDownlist(){
        $array = RefGudang::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_gudang');
    }
}
