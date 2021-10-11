<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "riwayat_stok_barang".
 *
 * @property int $id
 * @property string|null $tgl_masuk
 * @property string|null $barkode
 * @property int|null $id_data_agen
 * @property int|null $id_data_barang
 * @property int|null $stok_awal
 * @property int|null $stok_akhir
 * @property int|null $stok_sisa
 * @property float|null $harga_jual
 * @property string|null $no_invoice
 */
class RiwayatStokBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayat_stok_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_masuk'], 'safe'],
            [['id_data_agen', 'id_data_barang', 'stok_awal', 'stok_akhir', 'stok_sisa'], 'integer'],
            [['harga_jual'], 'number'],
            [['barkode', 'no_invoice'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_masuk' => 'Tgl Masuk',
            'barkode' => 'Barkode',
            'id_data_agen' => 'Id Data Agen',
            'id_data_barang' => 'Id Data Barang',
            'stok_awal' => 'Stok Awal',
            'stok_akhir' => 'Stok Akhir',
            'stok_sisa' => 'Stok Sisa',
            'harga_jual' => 'Harga Jual',
            'no_invoice' => 'No Invoice',
        ];
    }
}
