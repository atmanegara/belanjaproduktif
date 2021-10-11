<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "checkout_item".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $tgl_invoice
 * @property string|null $no_invoice
 * @property int|null $id_data_barang
 * @property int|null $harga_jual
 * @property int|null $qty
 * @property int|null $total
 * @property string|null $tgl_masuk
 */
class CheckoutItem extends \yii\db\ActiveRecord
{
    
    public $id_metode_pembayaran,$id_ref_kurir,$tgl_dikirim,$jam_dikirim;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkout_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total','duit_tunai','duit_kembali'], 'number'],
            [['id_metode_pembayaran','tgl_invoice'],'required','message'=>'Wajib di isi'],
            [['tgl_invoice', 'tgl_masuk','tgl_dikirim'], 'safe'],
            [['id_data_barang', 'harga_jual','harga_satuan', 'qty', 'id_metode_pembayaran','id_ref_kurir','id_data_toko','ongkir'], 'integer'],
            [['no_acak', 'no_invoice'], 'string', 'max' => 50],
            [['jam_dikirim'],'string','max'=>5]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'tgl_invoice' => 'Tgl Invoice',
            'no_invoice' => 'No Invoice',
            'id_data_barang' => 'Barang',
            'harga_jual' => 'Harga Jual',
            'qty' => 'Qty',
            'total' => 'Total',
            'tgl_masuk' => 'Tgl Masuk',
            'id_metode_pembayaran'=>'Metode Pembayaran',
            'id_ref_kurir'=>'Mitra Kurir'
        ];
    }
    
    public static function total($no_invoice){
        $array = (new \yii\db\Query())
                ->select(['sum(total) total'])->from('checkout_item')->where(['no_invoice'=>$no_invoice])->one();
        return $array['total'];
    }
}
