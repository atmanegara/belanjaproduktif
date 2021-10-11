<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_bank".
 *
 * @property int $id
 * @property string|null $nm_bank
 */
class RefBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['nm_bank'], 'required', 'message' => 'Wajib di isi'],
            [['nm_bank'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm_bank' => 'Nm Bank',
        ];
    }
    
    public static function getDropdownbank(){
        $array = RefBank::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nm_bank');
    }
}
