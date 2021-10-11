<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_toko".
 *
 * @property int $id
 * @property int|null $id_data_toko
 * @property int|null $hari
 * @property string|null $jam_awal
 * @property string|null $jam_akhir
 * @property string|null $aktif
 * @property string|null $ket
 */
class DetailToko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_toko';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_toko', 'hari'], 'integer'],
            [['jam_awal', 'jam_akhir'], 'safe'],
            [['aktif'], 'string'],
            [['ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_toko' => 'Id Data Toko',
            'hari' => 'Hari',
            'jam_awal' => 'Jam Awal',
            'jam_akhir' => 'Jam Akhir',
            'aktif' => 'Aktif',
            'ket' => 'Ket',
        ];
    }
}
