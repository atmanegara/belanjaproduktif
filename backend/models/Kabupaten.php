<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 *
 * @property string $id_kab
 * @property string $id_prov
 * @property string $nama
 * @property int $id_jenis
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kabupaten';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kab', 'id_prov', 'nama', 'id_jenis'], 'required'],
            [['nama'], 'string'],
            [['id_jenis'], 'integer'],
            [['id_kab'], 'string', 'max' => 4],
            [['id_prov'], 'string', 'max' => 2],
            [['id_kab'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kab' => 'Id Kab',
            'id_prov' => 'Id Prov',
            'nama' => 'Nama',
            'id_jenis' => 'Id Jenis',
        ];
    }
    
    public static function dropdownlist()
    {
        $array = Kabupaten::find()->where(['id_prov'=>"63"])->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array,'id_kab','nama');
    }
}
