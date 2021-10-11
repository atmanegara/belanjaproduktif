<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_proses_pendaftaran".
 *
 * @property int $id
 * @property string|null $nama_proses
 *
 * @property RegistrasiAgen[] $registrasiAgens
 */
class RefProsesPendaftaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_proses_pendaftaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_proses'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_proses' => 'Nama Proses',
        ];
    }

    /**
     * Gets query for [[RegistrasiAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrasiAgens()
    {
        return $this->hasMany(RegistrasiAgen::className(), ['id_ref_proses_pendaftaran' => 'id']);
    }
    
    public static function getdropdownlist(){
        $array = RefProsesPendaftaran::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nama_proses');
    }
}
