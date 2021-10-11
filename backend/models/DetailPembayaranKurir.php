<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_pembayaran_kurir".
 *
 * @property int $id
 * @property string|null $no_invoice
 * @property int|null $id_data_kurir
 * @property int|null $status_pesanan_kurir 0:proses,1:barang diterima
 */
class DetailPembayaranKurir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pembayaran_kurir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_kurir', 'status_pesanan_kurir'], 'integer'],
            [['no_invoice'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_invoice' => 'No Invoice',
            'id_data_kurir' => 'Anggota Kurir',
            'status_pesanan_kurir' => 'Status Pesanan Kurir',
        ];
    }
}
