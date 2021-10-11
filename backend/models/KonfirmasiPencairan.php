<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "konfirmasi_pencairan".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property int|null $id_metode_transfer
 * @property string|null $from_bank
 * @property string|null $tgl_ajukan
 * @property int|null $id_data_agen
 * @property float|null $nominal
 * @property int|null $id_status_pembayaran
 * @property string $jamtgl
 */
class KonfirmasiPencairan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konfirmasi_pencairan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_metode_transfer', 'id_data_agen', 'id_status_pembayaran','status_pencarian','pencarian_sbg'], 'integer'],
            [['tgl_ajukan','tgl_verifikasi', 'jamtgl'], 'safe'],
            [['nominal'], 'number'],
            [['no_acak', 'no_invoice', 'from_bank'], 'string', 'max' => 50],
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
            'id_metode_transfer' => 'Metode Transfer',
            'from_bank' => 'From Bank',
            'tgl_ajukan' => 'Tgl Ajukan',
            'id_data_agen' => 'Data ID Agen',
            'nominal' => 'Nominal',
            'id_status_pembayaran' => 'Verifikasi Pencairaan',
            'jamtgl' => 'Jamtgl',
        ];
    }
}
