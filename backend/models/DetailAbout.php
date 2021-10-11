<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_about".
 *
 * @property int $id
 * @property int|null $id_tentang_kami
 * @property string|null $tag_line
 * @property string|null $header
 */
class DetailAbout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tentang_kami'], 'integer'],
            [['header'], 'string'],
            [['tag_line'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tentang_kami' => 'Id Tentang Kami',
            'tag_line' => 'Tag Line',
            'header' => 'Header',
        ];
    }
}
