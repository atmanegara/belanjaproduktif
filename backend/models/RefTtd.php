<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_ttd".
 *
 * @property int $id
 * @property string|null $id_laporan 1:laporan invoice pendaftaran
 * @property string|null $no_induk
 * @property string|null $nama
 */
class RefTtd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_ttd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_laporan', 'no_induk', 'nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_laporan' => 'Id Laporan',
            'no_induk' => 'No Induk',
            'nama' => 'Nama',
        ];
    }
}
