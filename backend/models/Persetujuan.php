<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "persetujuan".
 *
 * @property int $id
 * @property string|null $persetujuan
 */
class Persetujuan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persetujuan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persetujuan'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'persetujuan' => 'Persetujuan',
        ];
    }
}
