<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tahap".
 *
 * @property int $id
 * @property string|null $ket
 */
class Tahap extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tahap';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'ket' => 'Ket',
        ];
    }
}
