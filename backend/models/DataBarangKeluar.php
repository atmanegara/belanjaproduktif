<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_barang_keluar".
 *
 * @property int $id
 * @property int|null $id_data_barang
 * @property int|null $qty
 * @property float|null $harga
 * @property string|null $tgl_keluar
 * @property string|null $tgl_input
 */
class DataBarangKeluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_barang_keluar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_barang', 'qty'], 'integer'],
            [['harga'], 'number'],
            [['tgl_keluar', 'tgl_input'], 'safe'],
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
            'qty' => 'Qty',
            'harga' => 'Harga',
            'tgl_keluar' => 'Tgl Keluar',
            'tgl_input' => 'Tgl Input',
        ];
    }
}
