<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "registrasi_agen".
 *
 * @property int $id
 * @property string|null $id_referen_agen
 * @property string|null $no_reg
 * @property string|null $no_acak
 * @property string|null $nik
 * @property string|null $nama
 * @property string|null $alamat
 * @property string|null $rt_rw
 * @property string|null $id_kab
 * @property string|null $id_kelurahan
 * @property string|null $id_kecamatan
 * @property string|null $nope
 * @property string|null $email
 * @property int|null $id_ref_agen
 * @property int|null $id_ref_proses_pendaftaran
 * @property string|null $setuju
 *
 * @property RefAgen $refAgen
 * @property RefProsesPendaftaran $refProsesPendaftaran
 */
class RegistrasiAgen extends \yii\db\ActiveRecord
{
    public $nama_agen,$username;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registrasi_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen','nik','alamat','nama','nope','username'],'required','message'=>'Wajib di isi'],
            [['tgl_registrasi'],'safe'],
            [['alamat', 'setuju'], 'string'],
            [['id_ref_agen', 'id_ref_proses_pendaftaran'], 'integer'],
            [['id_referen_agen', 'no_reg', 'no_acak', 'nik', 'nama', 'nope', 'email','username'], 'string', 'max' => 50],
            [['rt_rw', 'id_kab'], 'string', 'max' => 11],
            [['id_kelurahan', 'id_kecamatan'], 'string', 'max' => 12],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
            [['id_ref_proses_pendaftaran'], 'exist', 'skipOnError' => true, 'targetClass' => RefProsesPendaftaran::className(), 'targetAttribute' => ['id_ref_proses_pendaftaran' => 'id']],
          ['nik', 'string', 'min' => 16, 'max' => 16, 'message' => 'Panjang harus 16 karakter'],
         ['nik', 'unique',  'message' => 'NIK Sudah digunakan.'],
          ['username', 'trim'],
       //     ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username sudah ada'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_referen_agen' => 'Id Referen Agen',
            'no_reg' => 'Nomor Reg',
            'no_acak' => 'Nomor Acak',
            'nik' => 'NIK',
            'nama' => 'NAMA',
            'alamat' => 'ALAMAT',
            'rt_rw' => 'RT/ RW',
            'id_kab' => 'KABUPATEN',
            'id_kelurahan' => 'KELURAHAN',
            'id_kecamatan' => 'KECAMATAN',
            'nope' => 'Nomor. TELP',
            'email' => 'E-MAIL (AKTIF)',
            'id_ref_agen' => 'Id Ref Agen',
            'id_ref_proses_pendaftaran' => 'STATUS PENDAFTARAN',
            'setuju' => 'PERSETUJUAN',
            'username'=>'USERNAME'
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

    /**
     * Gets query for [[RefProsesPendaftaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProsesPendaftaran()
    {
        return $this->hasOne(RefProsesPendaftaran::className(), ['id' => 'id_ref_proses_pendaftaran']);
    }
}
