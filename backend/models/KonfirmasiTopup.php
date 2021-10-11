<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "konfirmasi_topup".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property int|null $id_metode_transfer
 * @property int|null $nominal
 * @property string|null $from_bank
 * @property string|null $tgl_transfer
 * @property string|null $filename
 * @property int|null $id_status_pembayaran
 *
 * @property MetodeTransfer $metodeTransfer
 * @property StatusPembayaran $statusPembayaran
 */
class KonfirmasiTopup extends \yii\db\ActiveRecord
{
    public $filedok;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konfirmasi_topup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filedok'],'file','skipOnEmpty'=>false,'maxFiles'=>1],
            [['id_metode_transfer', 'nominal', 'id_status_pembayaran','id_ket_saldo'], 'integer'],
            [['tgl_transfer'], 'safe'],
            [['ket'], 'string', 'max' => 160],
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
            'id_metode_transfer' => 'Metode Transfer',
            'nominal' => 'Nominal',
            'from_bank' => 'Nama Bank Transfer',
            'tgl_transfer' => 'Tgl Transfer',
            'filename' => 'Filename',
            'id_status_pembayaran' => 'Status Pembayaran',
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
    
    public function upload(){
        if($this->validate()){
            $filename = date('YmdHis').'.'.$this->filedok->extension;
            $this->filename=$filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
}
