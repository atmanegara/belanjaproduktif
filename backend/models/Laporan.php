<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "laporan".
 *
 * @property int $id
 * @property string|null $jns_laporan
 */
class Laporan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'laporan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jns_laporan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jns_laporan' => 'Jns Laporan',
        ];
    }
}
