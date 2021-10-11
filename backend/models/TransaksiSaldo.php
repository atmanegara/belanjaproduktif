<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaksi_saldo".
 *
 * @property int $id
 * @property string|null $tgl_transaksi
 * @property string|null $no_acak
 * @property float|null $nominal_masuk
 * @property float|null $nominal_keluar
 * @property float|null $nominal_sisa
 * @property int|null $id_metode_transfer
 * @property int|null $id_ref_bank
 * @property int|null $id_ket_saldo
 */
class TransaksiSaldo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_saldo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_transaksi'], 'safe'],
            [['nominal_masuk','nominal_keluar','nominal_sisa'], 'number'],
            [['id_metode_transfer', 'id_ref_bank','id_ket_saldo'], 'integer'],
            [['no_acak'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_transaksi' => 'Tgl Transaksi',
            'no_acak' => 'No Acak',
            'nominal_masuk' => 'Nominal Masuk',
            'id_metode_transfer' => 'Metode Pembayaran',
            'id_ref_bank' => 'Bank',
        ];
    }
}
