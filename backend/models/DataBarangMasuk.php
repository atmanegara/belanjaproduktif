<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_barang_masuk".
 *
 * @property int $id
 * @property int|null $id_ref_barang
 * @property int|null $id_ref_suplier
 * @property int|null $qty
 * @property float|null $harga_satuan
 * @property int|null $id_ref_gudang
 * @property string|null $tgl_masuk
 * @property string|null $tgl_input
 */
class DataBarangMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_barang_masuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_barang', 'id_ref_suplier', 'qty', 'id_ref_gudang','harga_satuan','tgl_masuk'], 'required','message'=>'wajib di isi'],
            [['id_ref_barang', 'id_ref_suplier', 'qty', 'id_ref_gudang'], 'integer'],
            [['harga_satuan'], 'number'],
            [['tgl_masuk', 'tgl_input'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_barang' => 'Item Barang',
            'id_ref_suplier' => 'Supplier',
            'qty' => 'Qty',
            'harga_satuan' => 'Harga Satuan',
            'id_ref_gudang' => 'Gudang',
            'tgl_masuk' => 'Tgl Masuk',
            'tgl_input' => 'Tgl Input',
        ];
    }
}
