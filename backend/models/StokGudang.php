<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stok_gudang".
 *
 * @property int $id
 * @property int|null $id_ref_gudang
 * @property int|null $id_ref_barang
 * @property int|null $qty
 * @property float|null $harga_satuan
 * @property float|null $harga_jual
 */
class StokGudang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stok_gudang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_gudang', 'id_ref_barang', 'qty'], 'integer'],
            [['harga_satuan', 'harga_jual'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_gudang' => 'Id Ref Gudang',
            'id_ref_barang' => 'Id Ref Barang',
            'qty' => 'Qty',
            'harga_satuan' => 'Harga Satuan',
            'harga_jual' => 'Harga Jual',
        ];
    }
}
