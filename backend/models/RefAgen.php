<?php

namespace backend\models;

use Yii;

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
            [['kd_agen','nama_agen'],'required','message'=>'Wajib di isi'],
             [['kd_agen'], 'string', 'max' => 8],
            [['nama_agen'], 'string', 'max' => 50],
     //       [['id_ref_syarat_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefSyaratAgen::className(), 'targetAttribute' => ['id_ref_syarat_agen' => 'id']],
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
    
    public static function getDropdownlist(){
        $array = RefAgen::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_agen');
    }
        public static function getDropdownlistByAktif(){
        $array = RefAgen::find()->where(['aktif'=>'Y'])->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_agen');
    }
            public static function getDropdownlistOneAgen($id){
                
        $array = RefAgen::find();
        switch ($id){
            case 1:
               $array= $array->where(['id'=>[2]])->asArray()->all();
                break;
            case 2:
               $array= $array->where(['id'=>[2,3]])->asArray()->all();
                break;
            case 3:
                $array= $array->where(['id'=>[3,4]])->asArray()->all();
               break;
             case 7:
               $array= $array->where(['id'=>[2,3]])->asArray()->all();
                break;
        }        
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_agen');
    }
}
