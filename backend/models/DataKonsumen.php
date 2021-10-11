<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_konsumen".
 *
 * @property int $id
 * @property string|null $nama
 * @property int|null $jkel
 * @property string|null $no_telp
 * @property string|null $email
 * @property string|null $filename
 *
 * @property AlamatKonsumen[] $alamatKonsumens
 */
class DataKonsumen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_konsumen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jkel'], 'integer'],
            [['nama', 'no_telp', 'email', 'filename','no_acak'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'jkel' => 'Jkel',
            'no_telp' => 'No Telp',
            'email' => 'Email',
            'filename' => 'Filename',
        ];
    }

    /**
     * Gets query for [[AlamatKonsumens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlamatKonsumens()
    {
        return $this->hasMany(AlamatKonsumen::className(), ['id_data_konsumen' => 'id']);
    }
}
