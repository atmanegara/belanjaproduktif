<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "informasi_kami".
 *
 * @property int|null $id
 * @property string|null $visi_misi
 */
class InformasiKami extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informasi_kami';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['visi_misi'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visi_misi' => 'Visi Misi',
        ];
    }
}
