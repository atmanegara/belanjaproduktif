<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaksi_komisi".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_acak_penerima
 * @property string|null $tgl_masuk
 * @property int|null $id_data_agen
 * @property int|null $id_data_barang
 * @property int|null $id_ref_barang
 * @property float|null $jumlah total pembelian, total franchice,ambil program
 * @property float|null $nilai_bagi persen
 * @property float|null $nominal bagi hasil
 * @property string|null $ket sumber dr kolom jumlah
 * @property int|null $tahun
 *
 * @property DataAgen $dataAgen
 */
class TransaksiKomisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_komisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_agen', 'tahun','ket','id_data_barang','id_ref_barang'], 'integer'],
            [['tgl_masuk'], 'safe'],
            [['jumlah', 'nilai_bagi', 'nominal'], 'number'],
            [['no_acak','no_acak_penerima', 'no_acak_pemberi'], 'string', 'max' => 50],
            [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
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
            'no_acak_penerima' => 'No Acak',
            'tgl_masuk' => 'Tgl Masuk',
            'id_data_agen' => 'Id Data Agen',
            'jumlah' => 'Jumlah',
            'nilai_bagi' => 'Nilai Bagi',
            'nominal' => 'Nominal',
            'ket' => 'Ket',
            'tahun' => 'Tahun',
        ];
    }

    /**
     * Gets query for [[DataAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgen()
    {
        return $this->hasOne(DataAgen::className(), ['id' => 'id_data_agen']);
    }
    
      /**
     * Gets query for [[RefSumberKomisi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefSumberKomisi()
    {
        return $this->hasOne(RefSumberKomisi::className(), ['id' => 'id_ref_sumber_komisi']);
    }
}
