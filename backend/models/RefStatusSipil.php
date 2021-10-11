<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_status_sipil".
 *
 * @property int $id
 * @property string|null $nama_status_sipil
 *
 * @property DataAgen[] $dataAgens
 */
class RefStatusSipil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_status_sipil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_status_sipil'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_status_sipil' => 'Nama Status Sipil',
        ];
    }

    /**
     * Gets query for [[DataAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgens()
    {
        return $this->hasMany(DataAgen::className(), ['id_ref_status_sipil' => 'id']);
    }
    
    public static function DropDownlist(){
        $array = RefStatusSipil::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nama_status_sipil');
    }
}
