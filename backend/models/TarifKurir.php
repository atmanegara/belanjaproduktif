<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tarif_kurir".
 *
 * @property int $id
 * @property int $id_ref_kurir
 * @property int|null $hari
 * @property string|null $jam_awal
 * @property string|null $jam_akhir
 * @property float|null $tarif
 */
class TarifKurir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarif_kurir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_kurir', 'hari'], 'integer'],
            [['tarif'], 'number'],
            [['jam_awal', 'jam_akhir'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_kurir' => 'Id Ref Kurir',
            'hari' => 'Hari',
            'jam_awal' => 'Jam Awal',
            'jam_akhir' => 'Jam Akhir',
            'tarif' => 'Tarif',
        ];
    }
}
