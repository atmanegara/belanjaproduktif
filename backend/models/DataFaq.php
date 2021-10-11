<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_faq".
 *
 * @property int $id
 * @property string|null $pertanyaan
 * @property string|null $jawaban
 * @property string|null $aktif
 */
class DataFaq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pertanyaan', 'jawaban', 'aktif'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pertanyaan' => 'Pertanyaan',
            'jawaban' => 'Jawaban',
            'aktif' => 'Aktif',
        ];
    }
}
