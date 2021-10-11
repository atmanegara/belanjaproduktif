<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_pembayaran".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property int|null $id_metode_pembayaran
 * @property int|null $id_ref_kurir
 * @property string|null $tgl_dikirim
 * @property string|null $jam_dikirim
 * @property string|null $jam_dikirim_kurir
 *
 * @property MetodePembayaran $metodePembayaran
 * @property RefKurir $refKurir
 */
class DetailPembayaran extends \yii\db\ActiveRecord
{
    public $nama_metode_pembayaran;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_metode_pembayaran', 'id_ref_kurir'], 'integer'],
            [['tgl_dikirim'], 'safe'],
            [['no_acak', 'no_invoice', 'jam_dikirim','jam_dikirim_kurir'], 'string', 'max' => 50],
            [['id_metode_pembayaran'], 'exist', 'skipOnError' => true, 'targetClass' => MetodePembayaran::className(), 'targetAttribute' => ['id_metode_pembayaran' => 'id']],
            [['id_ref_kurir'], 'exist', 'skipOnError' => true, 'targetClass' => RefKurir::className(), 'targetAttribute' => ['id_ref_kurir' => 'id']],
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
            'id_metode_pembayaran' => 'Id Metode Pembayaran',
            'id_ref_kurir' => 'Id Ref Kurir',
            'tgl_dikirim' => 'Tgl Dikirim',
            'jam_dikirim' => 'Jam Dikirim',
        ];
    }

    /**
     * Gets query for [[MetodePembayaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMetodePembayaran()
    {
        return $this->hasOne(MetodePembayaran::className(), ['id' => 'id_metode_pembayaran']);
    }

    /**
     * Gets query for [[RefKurir]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKurir()
    {
        return $this->hasOne(RefKurir::className(), ['id' => 'id_ref_kurir']);
    }
    
//    public static function getDataDetailPembayaran($no_acak){
//        $array = (new \yii\db\Query())
//                ->select(['a.no_acak,a.no_invoice,b.nama_kurir'])
//    }
}
