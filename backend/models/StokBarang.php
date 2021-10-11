<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "stok_barang".
 *
 * @property int $id
 * @property string|null $tgl_masuk
 * @property int|null $id_data_agen
 * @property int|null $id_data_barang
 * @property int|null $stok_awal
 * @property int|null $stok_akhir
 * @property int|null $stok_sisa
 *
 * @property DataAgen $dataAgen
 * @property DataBarang $dataBarang
 */
class StokBarang extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'stok_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['backode'], 'string'],
            [['id', 'id_data_agen', 'id_data_barang', 'stok_awal', 'stok_akhir', 'stok_sisa'], 'integer'],
            [['tgl_masuk'], 'safe'],
            [['id'], 'unique'],
            [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
            [['id_data_barang'], 'exist', 'skipOnError' => true, 'targetClass' => DataBarang::className(), 'targetAttribute' => ['id_data_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'tgl_masuk' => 'Tgl Masuk',
            'id_data_agen' => 'Id Data Agen',
            'id_data_barang' => 'Id Data Barang',
            'stok_awal' => 'Stok Awal',
            'stok_akhir' => 'Stok Akhir',
            'stok_sisa' => 'Stok Sisa',
        ];
    }

    /**
     * Gets query for [[DataAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgen() {
        return $this->hasOne(DataAgen::className(), ['id' => 'id_data_agen']);
    }

    /**
     * Gets query for [[DataBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataBarang() {
        return $this->hasOne(DataBarang::className(), ['id' => 'id_data_barang']);
    }

    public static function getQty($id_data_agen, $id_data_barang) {
        $array = StokBarang::findOne(['id_data_agen' => $id_data_agen, 'id_data_barang' => $id_data_barang]);
        $qty = 0;
        if ($array) {
            $qty = $array['stok_awal'];
        } else {
            $qty = 0;
        }
        return $qty;
    }

    public static function getSisaQty($id_data_agen, $id_data_barang) {
        $array = StokBarang::findOne(['id_data_agen' => $id_data_agen, 'id_data_barang' => $id_data_barang]);
        $qty = 0;
        if ($array) {
            $qty = $array['stok_sisa'];
        } else {
            $qty = 0;
        }
        return $qty;
    }
   public static function getJlhQty($id_data_agen, $id_data_barang) {
        $array = StokBarang::findOne(['id_data_agen' => $id_data_agen, 'id_data_barang' => $id_data_barang]);
        $qty = 0;
        if ($array) {
            $qty = $array['stok_akhir'];
        } else {
            $qty = 0;
        }
        return $qty;
    }
}
