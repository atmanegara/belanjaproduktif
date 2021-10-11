<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_jam".
 *
 * @property int $id
 * @property string|null $jam
 * @property string|null $aktif
 */
class RefJam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_jam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aktif'], 'string'],
            [['jam'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jam' => 'Jam',
            'aktif' => 'Aktif',
        ];
    }
    
   
}
