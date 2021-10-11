<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "riwayat_pencairan".
 *
 * @property string $no_acak_arsip
 * @property string $tgl_pencairan
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property int|null $id_metode_transfer
 * @property string|null $from_bank
 * @property string|null $tgl_ajukan
 * @property string|null $tgl_verifikasi
 * @property int|null $id_data_agen agen yang ditransfer ke agen..
 * @property float|null $nominal
 * @property int|null $id_status_pembayaran
 * @property int|null $id_ket
 * @property int|null $status_pencarian 1:ke agen, 2:kebank
 * @property int|null $pencarian_sbg 1:saldo,2:komisi
 * @property string $jamtgl
 */
class RiwayatPencairan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayat_pencairan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_acak_arsip', 'tgl_pencairan'], 'required'],
            [['tgl_pencairan', 'tgl_ajukan', 'tgl_verifikasi', 'jamtgl'], 'safe'],
            [['id_metode_transfer', 'id_data_agen', 'id_status_pembayaran', 'id_ket', 'status_pencarian', 'pencarian_sbg'], 'integer'],
            [['nominal'], 'number'],
            [['no_acak_arsip', 'no_acak', 'no_invoice', 'from_bank'], 'string', 'max' => 50],
            [['no_acak_arsip'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_acak_arsip' => 'No Acak Arsip',
            'tgl_pencairan' => 'Tgl Pencairan',
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'no_invoice' => 'No Invoice',
            'id_metode_transfer' => 'Id Metode Transfer',
            'from_bank' => 'From Bank',
            'tgl_ajukan' => 'Tgl Ajukan',
            'tgl_verifikasi' => 'Tgl Verifikasi',
            'id_data_agen' => 'Id Data Agen',
            'nominal' => 'Nominal',
            'id_status_pembayaran' => 'Id Status Pembayaran',
            'id_ket' => 'Id Ket',
            'status_pencarian' => 'Status Pencarian',
            'pencarian_sbg' => 'Pencarian Sbg',
            'jamtgl' => 'Jamtgl',
        ];
    }
}
