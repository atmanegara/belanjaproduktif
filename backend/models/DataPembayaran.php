<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_pembayaran".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property int|null $id_metode_transfer
 * @property int|null $nominal
 * @property string|null $from_bank
 * @property string|null $tgl_transfer
 * @property string $tgl_konfirmasi
 * @property string|null $filename
 * @property int|null $id_status_pembayaran
 * @property int|null $id_status_dp
 *
 * @property MetodeTransfer $metodeTransfer
 * @property StatusPembayaran $statusPembayaran
 */
class DataPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_metode_transfer', 'nominal', 'id_status_pembayaran', 'id_status_dp'], 'integer'],
            [['tgl_transfer', 'tgl_konfirmasi'], 'safe'],
            [['no_acak', 'no_invoice', 'from_bank', 'filename'], 'string', 'max' => 50],
            [['id_metode_transfer'], 'exist', 'skipOnError' => true, 'targetClass' => MetodeTransfer::className(), 'targetAttribute' => ['id_metode_transfer' => 'id']],
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
            'id_metode_transfer' => 'Id Metode Transfer',
            'nominal' => 'Nominal',
            'from_bank' => 'From Bank',
            'tgl_transfer' => 'Tgl Transfer',
            'tgl_konfirmasi' => 'Tgl Konfirmasi',
            'filename' => 'Filename',
            'id_status_pembayaran' => 'Id Status Pembayaran',
            'id_status_dp' => 'Id Status Dp',
        ];
    }

    /**
     * Gets query for [[MetodeTransfer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodeTransfer()
    {
        return $this->hasOne(MetodeTransfer::className(), ['id' => 'id_metode_transfer']);
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
