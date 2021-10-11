<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catatan_barang_agen".
 *
 * @property int $id
 * @property string|null $id_data_agen
 * @property string|null $tgl_pemesanan
 * @property string $selesai Description
 * @property string $diterima Description
 * @property string $catatan Description
 */
class CatatanBarangAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catatan_barang_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_pemesanan'], 'safe'],
            [['id_data_agen','selesai','diterima','catatan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_agen' => 'Agen',
            'tgl_pemesanan' => 'Tgl Pemesanan',
        ];
    }
    
    public function getDataAgen(){
       return $this->hasOne(DataAgen::className(),['id'=>'id_data_agen']);
    }
    
     public static function getStatusTerimaBarang($no_acak){
        $status = CatatanBarangAgen::find()->where([
            'no_acak'=>$no_acak
        ])->one();
                return $status['diterima'];
    }
}
