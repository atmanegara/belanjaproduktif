<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_posting".
 *
 * @property int $id
 * @property string|null $ket_posting
 */
class RefPosting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_posting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket_posting'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ket_posting' => 'Ket Posting',
        ];
    }
    
    public static function dropDownListPosting(){
        $array = RefPosting::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'ket_posting');
    }
}
