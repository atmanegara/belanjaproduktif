<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "status_dp".
 *
 * @property int $id
 * @property string|null $ket
 */
class StatusDp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_dp';
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
    
    public static function dropdownlist(){
        $array = StatusDp::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'ket');
    }
}
