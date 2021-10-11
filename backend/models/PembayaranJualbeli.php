<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pembayaran_jualbeli".
 *
 * @property int $id
 * @property string $no_acak
 * @property string|null $no_invoice
 * @property string|null $no_virtual_akun
 * @property string|null $no_berita
 * @property int|null $id_ref_bank
 * @property string|null $tgl_transfer
 * @property float|null $total_bayar
 * @property int|null $id_status_pembayaran
 *
 * @property StatusPembayaran $statusPembayaran
 */
class PembayaranJualbeli extends \yii\db\ActiveRecord
{
    public $id_metode_pembayaran,$filedok,$id_ref_kurir,$tgl_dikirim,$jam_dikirim;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembayaran_jualbeli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_kurir','tgl_dikirim','jam_dikirim'],'required','message'=>'Wajib di Isi'],
            [['filedok'],'file','skipOnEmpty'=>false],
            [['id_ref_bank', 'id_status_pembayaran','id_ref_kurir','id_metode_pembayaran'], 'integer'],
            [['tgl_transfer','tgl_dikirim'], 'safe'],
            [['total_bayar','nominal_ojek','duit_kembali'], 'number'],
            [['no_acak', 'no_invoice', 'no_virtual_akun', 'no_berita','jam_dikirim'], 'string', 'max' => 50],
            [['id_status_pembayaran'], 'exist', 'skipOnError' => true, 'targetClass' => StatusPembayaran::className(), 'targetAttribute' => ['id_status_pembayaran' => 'id']],
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
            'no_invoice' => 'No Invoice',
            'no_virtual_akun' => 'No Virtual Akun',
            'no_berita' => 'No Berita',
            'id_ref_bank' => 'Bank',
            'tgl_transfer' => 'Tgl Transfer',
            'total_bayar' => 'Total Bayar',
            'id_status_pembayaran' => 'Status Pembayaran',
            'id_metode_pembayaran'=>'Metode Pembayaran',
            'id_ref_kurir'=>'Kurir',
            'nominal_ojek'=>'Nominal Yang Dibayar'
        ];
    }

    /**
     * Gets query for [[StatusPembayaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPembayaran()
    {
        return $this->hasOne(StatusPembayaran::className(), ['id' => 'id_status_pembayaran']);
    }
}
