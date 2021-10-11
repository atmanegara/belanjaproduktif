<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_agen".
 *
 * @property int $id
 * @property string|null $kd_agen
 * @property string|null $nama_agen
 * @property int|null $id_ref_syarat_agen
 *
 * @property DataAgen[] $dataAgens
 * @property RefSyaratAgen $refSyaratAgen
 * @property RefJenisDok[] $refJenisDoks
 * @property RegistrasiAgen[] $registrasiAgens
 */
class RefAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_syarat_agen'], 'integer'],
            [['kd_agen'], 'string', 'max' => 8],
            [['nama_agen'], 'string', 'max' => 50],
            [['id_ref_syarat_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefSyaratAgen::className(), 'targetAttribute' => ['id_ref_syarat_agen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd_agen' => 'Kd Agen',
            'nama_agen' => 'Nama Agen',
            'id_ref_syarat_agen' => 'Id Ref Syarat Agen',
        ];
    }

    /**
     * Gets query for [[DataAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgens()
    {
        return $this->hasMany(DataAgen::className(), ['id_ref_agen' => 'id']);
    }

    /**
     * Gets query for [[RefSyaratAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefSyaratAgen()
    {
        return $this->hasOne(RefSyaratAgen::className(), ['id' => 'id_ref_syarat_agen']);
    }

    /**
     * Gets query for [[RefJenisDoks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisDoks()
    {
        return $this->hasMany(RefJenisDok::className(), ['id_ref_agen' => 'id']);
    }

    /**
     * Gets query for [[RegistrasiAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrasiAgens()
    {
        return $this->hasMany(RegistrasiAgen::className(), ['id_ref_agen' => 'id']);
    }
     public static function getDropdownAgenReg(){
        $array = RefAgen::find()->where(['id'=>[1,2,3,4]])->all();
        return ArrayHelper::map($array,'id','nama_agen');
    }
        public static function getDropdownAgenAktif(){
        $array = RefAgen::find()->where(['aktif'=>'Y'])->asArray()->all();
        return ArrayHelper::map($array,'id','nama_agen');
    }
    public static function getDropdownAgen(){
        $array = RefAgen::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nama_agen');
    }
       public static function getDropdownAgenById(){
        $array = RefAgen::find()->asArray()->where(['id'=>[1,4]])->all();
        return ArrayHelper::map($array,'id','nama_agen');
    }
}
