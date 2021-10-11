<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "atur_margin".
 *
 * @property int $id
 * @property int|null $id_ref_agen
 * @property float|null $nilai
 */
class AturMargin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atur_margin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen'], 'integer'],
            [['nilai'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_agen' => 'Agen',
            'nilai' => 'Nilai',
        ];
    }
}
