<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "booking_barang".
 *
 * @property int $id
 * @property string $kd_booking
 * @property int|null $id_stok_barang
 * @property int|null $qty_keluar
 * @property int|null $total
 * @property int|null $duit_tunai
 * @property int|null $duit_keluar
 * @property string|null $no_invoice
 * @property string|null $no_acak
 * @property string|null $tgl_batas_book
 * @property string|null $jam_batas_book
 * @property int|null $status_booking 1:Ya
 */
class BookingBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duit_tunai','status_booking'], 'required','message'=>'Wajib Di isi'],
            [['total','duit_tunai','duit_kembali','harga_satuan'], 'number'],
            [['id_stok_barang', 'qty_keluar', 'status_booking'], 'integer'],
            [['tgl_batas_book'], 'safe'],
            [['kd_booking', 'no_invoice', 'no_acak', 'jam_batas_book'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd_booking' => 'No Booking',
            'id_stok_barang' => 'Stok Barang',
            'qty_keluar' => 'Qty Keluar',
            'no_invoice' => 'No Invoice',
            'no_acak' => 'No Acak',
            'tgl_batas_book' => 'Tgl Batas Book',
            'jam_batas_book' => 'Jam Batas Book',
            'status_booking' => 'Status Booking',
        ];
    }
    
    public static function modelDataBooking($no_acak){
        $model = (new \yii\db\Query())
                ->select('a.*,cc.ket')
                ->from('booking_barang a')
                ->leftJoin('stok_barang b','a.id_stok_barang=b.id')
                ->leftJoin('detail_pembayaran bb','a.no_invoice=bb.no_invoice')
                ->leftJoin('metode_pembayaran cc','bb.id_metode_pembayaran=cc.id')
                ->leftJoin('data_agen c','b.id_data_agen=c.id')->where(['c.no_acak'=>$no_acak])->groupBy('a.kd_booking,a.no_invoice')->orderBy('id DESC');
        return $model;
    }
      public static function modelDataBookingStatus($no_acak,$status_booking){
        $model = (new \yii\db\Query())
                ->select('a.*,cc.ket')
                ->from('booking_barang a')
                ->leftJoin('stok_barang b','a.id_stok_barang=b.id')
                ->leftJoin('detail_pembayaran bb','a.no_invoice=bb.no_invoice')
                ->leftJoin('metode_pembayaran cc','bb.id_metode_pembayaran=cc.id')
                ->leftJoin('data_agen c','b.id_data_agen=c.id')->where(['c.no_acak'=>$no_acak,'a.status_booking'=>$status_booking])->groupBy('a.kd_booking')->orderBy('id DESC');
        return $model;
    }
        public static function modelDataBookingCount($no_acak,$status_booking=1){
        $model = (new \yii\db\Query())
                ->select('a.*')
                ->from('booking_barang a')
                ->leftJoin('stok_barang b','a.id_stok_barang=b.id')
                ->leftJoin('detail_pembayaran bb','a.no_invoice=bb.no_invoice')
                ->leftJoin('metode_pembayaran cc','bb.id_metode_pembayaran=cc.id')
                ->leftJoin('data_agen c','b.id_data_agen=c.id')->where(['c.no_acak'=>$no_acak,'a.status_booking'=>$status_booking])->groupBy('a.kd_booking')->count();
        return $model;
    }
}
