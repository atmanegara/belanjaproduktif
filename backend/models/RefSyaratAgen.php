<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_syarat_agen".
 *
 * @property int $id
 * @property int $id_ref_agen
 * @property string|null $syarat_daftar
 *
 * @property RefAgen $refAgen
 */
class RefSyaratAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_syarat_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen'], 'integer'],
            [['syarat_daftar','syarat_komisi','hak_wajib','id_ref_agen'], 'required','message'=>"Wajib di isi"],
            [['syarat_daftar','syarat_komisi','hak_wajib'], 'string'],
            ['id_ref_agen','unique','message'=>'Agen sudah ada'],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_agen' => 'Nama Agen',
            'syarat_daftar' => 'Syarat Pendaftar',
            'syarat_komisi' => 'Syarat Kententuan Komisi',
            'hak_wajib' => 'Hak dan Kewajiban Agen',
        ];
    }

    /**
     * Gets query for [[RefAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgen()
    {
        return $this->hasOne(RefAgen::className(), ['id' => 'id_ref_agen']);
    }
    
//    public function cekada($attribute){
//        $data = RefSyaratAgen::find()->where(['id_ref_agen'=>$this->id_ref_agen])->exists();
//        if($data){
//            return $this->addError($attribute,'Data sudah ada');
//        }
//    }
}
