<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "visi_misi_perusahaan".
 *
 * @property int $id
 * @property string|null $visi
 * @property string|null $misi
 */
class VisiMisiPerusahaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visi_misi_perusahaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visi', 'misi'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visi' => 'Visi',
            'misi' => 'Misi',
        ];
    }
}
