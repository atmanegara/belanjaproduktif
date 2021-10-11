<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "data_detail_agen".
 *
 * @property int $id
 * @property int $cara_daftar
 * @property int|null $id_data_agen
 * @property string|null $id_agen
 * @property string|null $id_referensi_agen
 * @property string|null $tgl_gabung
 * @property string|null $no_acak_referensi
 */
class DataDetailAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_detail_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cara_daftar', 'id_data_agen'], 'integer'],
            [['tgl_gabung'], 'safe'],
            [['id_agen', 'id_referensi_agen','no_acak_referensi','no_acak'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cara_daftar' => 'Cara Daftar',
            'id_data_agen' => 'Id Data Agen',
            'id_agen' => 'Id Agen',
            'id_referensi_agen' => 'Id Referensi Agen',
            'tgl_gabung' => 'Tgl Gabung',
        ];
    }
}
