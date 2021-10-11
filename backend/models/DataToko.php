<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_toko".
 *
 * @property int $id
 * @property int|null $id_data_agen
 * @property string|null $no_toko
 * @property string|null $alamat
 * @property string|null $id_kabupaten
 * @property string|null $id_kelurahan
 * @property string|null $id_kecamatan
 * @property string|null $telp
 * @property string|null $aktif
 */
class DataToko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_toko';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat','no_toko', 'id_kabupaten', 'id_kelurahan', 'id_kecamatan','nama_toko','telp'],'required','message'=>'Wajib di isi'],
             [['id', 'id_data_agen'], 'integer'],
            [['alamat', 'aktif'], 'string'],
            [['no_toko', 'id_kabupaten', 'id_kelurahan', 'id_kecamatan','nama_toko','no_acak'], 'string', 'max' => 50],
            [['telp'], 'string', 'max' => 20],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_agen' => 'Id Data Agen',
            'no_toko' => 'NO TOKO',
            'alamat' => 'ALAMAT',
            'id_kabupaten' => 'KABUPATEN',
            'id_kelurahan' => 'KELURAHAN',
            'id_kecamatan' => 'KECAMATAN',
            'telp' => 'Telp',
            'aktif' => 'Status Toko (Aktif==Buka/Siap)',
        ];
    }
     public function getKab()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kab' => 'id_kabupaten']);
    }
      public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kec' => 'id_kecamatan']);
    }

   

    /**
     * Gets query for [[Kelurahan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kel' => 'id_kelurahan']);
    }
}
