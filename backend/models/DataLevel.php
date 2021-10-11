<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_level".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property int|null $dari_id_ref_agen
 * @property int|null $ke_id_ref_agen
 * @property string|null $tgl_masuk
 * @property string|null $catatan
 */
class DataLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dari_id_ref_agen', 'ke_id_ref_agen'], 'integer'],
            [['tgl_masuk'], 'safe'],
            [['catatan'], 'string'],
            [['no_acak'], 'string', 'max' => 50],
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
            'dari_id_ref_agen' => 'Asal Agen',
            'ke_id_ref_agen' => 'Agen baru',
            'tgl_masuk' => 'Tgl Masuk',
            'catatan' => 'Catatan',
        ];
    }
}
