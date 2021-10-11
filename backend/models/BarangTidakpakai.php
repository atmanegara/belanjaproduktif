<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "barang_tidakpakai".
 *
 * @property int $id
 * @property int $id_data_barang
 * @property int|null $id_data_agen
 * @property string|null $alasan
 */
class BarangTidakpakai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_tidakpakai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_barang'], 'required'],
            [['id_data_barang', 'id_data_agen'], 'integer'],
            [['alasan'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_barang' => 'Id Data Barang',
            'id_data_agen' => 'Id Data Agen',
            'alasan' => 'Alasan',
        ];
    }
}
