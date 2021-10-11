<?php

namespace backend\models;

use Yii;
/**
 * This is the model class for table "konfirmasi_pembayaran".
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
class KonfirmasiPembayaran extends \yii\db\ActiveRecord
{
    public $filebukti,$role_id,$nominal_sisa,$status_dp,$nik;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'konfirmasi_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id','id_status_pembayaran','tgl_transfer'],'required','message'=>'Wajib di isi {attribute}'],
            [['filebukti'],'file','skipOnEmpty'=>false,'maxFiles'=>'1'],
            [['id_metode_transfer', 'nominal', 'id_status_pembayaran','role_id','id_status_dp'], 'integer'],
            [['tgl_transfer'], 'safe'],
            [['no_acak', 'no_invoice', 'from_bank', 'filename'], 'string'],
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
            'from_bank' => 'Dari Bank',
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
        //   foreach($this->filebuktias $filedoknya){
            $filename = $this->no_invoice.'_'. $this->from_bank.'_'.$this->nominal.'.'.$this->filebukti->extension;
            $this->filename = $filename;
                $this->filebukti->saveAs(Yii::getAlias('@path_upload/').$filename);
     //       }
            return true;
        }else{
            return false;
        }
    }
    public function reupload(){
        if($this->validate()){
            
            $pathfilename= Yii::getAlias('@path_upload/') . $this->filename;
            if(file_exists($pathfilename)){
                unlink($pathfilename);
            }
            $filename = $this->no_invoice.'_'. $this->from_bank.'_'.$this->nominal.'.'.$this->filebukti->extension;
            $this->filename = $filename;
            $this->filebukti->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
}
