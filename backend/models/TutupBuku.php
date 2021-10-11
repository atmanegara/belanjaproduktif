<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tutup_buku".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property int|null $kd_posting
 * @property string|null $thnbln_posting
 * @property int|null $user_id
 * @property string|null $no_acak_user
 * @property int $kd_posting
 */
class TutupBuku extends \yii\db\ActiveRecord
{
    
   // public $tgl_lapor_akhir;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tutup_buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_lapor','tgl_lapor_akhir'],'safe'],
         //      [['bulan_posting','tahun_posting'], 'required','message'=>'Wajib di isi'],
           //  ['tgl_lapor', 'required',,
         [['tgl_lapor'],'validateBulanTahun', 'on' => ['create']],
            [['kd_posting', 'user_id','verifikasi'], 'integer'],
            [['no_acak', 'tahun_posting','bulan_posting', 'no_acak_user'], 'string', 'max' => 50],
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
            'kd_posting' => 'Kd Posting',
            'tahun_posting' => 'Thnbln Posting',
            'user_id' => 'User ID',
            'no_acak_user' => 'No Acak User',
        ];
    }
    
    public function validateBulanTahun($attribute){
        $model = TutupBuku::find()->where([
            'no_acak_user'=>$this->no_acak_user,
            'tgl_lapor'=>$this->tgl_lapor,
            'tgl_lapor_akhir'=>$this->tgl_lapor_akhir
        ])->exists();
        if($model){
           $this->addError($attribute, 'Bulan dan Tahun Transaksi sudah dilaporkan');
        }
    }
}
