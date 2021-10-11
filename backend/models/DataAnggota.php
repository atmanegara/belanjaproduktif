<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_anggota".
 *
 * @property int $id
 * @property string $no_acak
 * @property string $no_acak_agen
 * @property string $nama_agen
 * @property string $nik
 * @property int $id_ref_agen
 */
class DataAnggota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_agen', 'nik','id_ref_agen','alamat','nope'], 'required','message'=>'Wajib di isi'],
               ['nik', 'unique',  'message' => 'NIK Sudah digunakan.'],
            [['id_ref_agen'], 'integer'],
            [['no_acak', 'no_acak_agen', 'nama_agen', 'nik','alamat'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'no_acak_agen' => 'No Acak Agen',
            'nama_agen' => 'Nama Agen',
            'nik' => 'NIK',
            'id_ref_agen' => 'Id Ref Agen',
        ];
    }
    
    public static function dataAnggotaByRefAgen($id_ref_agen){
        $data = (new \yii\db\Query())
                ->select('a.*')
                ->from('data_agen a')
                ->innerJoin('data_anggota b','a.no_acak=b.no_acak_agen')->where(['a.id_ref_agen'=>$id_ref_agen])->groupBy('b.no_acak_agen');
        return $data;
    }
    
    public static function jumAnggota($no_acak){
        $dataJumAnggota = DataAnggota::find()->where(['no_acak_agen'=>$no_acak])->count();
        return !$dataJumAnggota ? 0 : $dataJumAnggota;
    }
}
