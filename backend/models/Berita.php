<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "berita".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $isi
 */
class Berita extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'berita';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isi'], 'string'],
            [['title'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'isi' => 'Isi',
        ];
    }
}
