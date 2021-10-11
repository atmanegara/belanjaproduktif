<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "file_jenis".
 *
 * @property int $id
 * @property string|null $nama_jenis
 * @property string|null $aktif
 */
class FileJenis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_jenis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aktif'], 'string'],
            [['nama_jenis'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_jenis' => 'Nama Jenis',
            'aktif' => 'Aktif',
        ];
    }
    
    public static function dropdownlist(){
        $array = FileJenis::find()->asArray()->all();
        return ArrayHelper::map($array, 'id', 'nama_jenis');
    }
}
