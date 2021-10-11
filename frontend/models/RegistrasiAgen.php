<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "registrasi_agen".
 *
 * @property int $id
 * @property string|null $no_reg
 * @property string|null $nik
 * @property string|null $nama
 * @property string|null $alamat
 * @property string|null $rt_rw
 * @property int|null $id_ref_kelurahan
 * @property int|null $id_ref_kecamatan
 * @property string|null $nope
 * @property int|null $id_ref_agen
 * @property int|null $id_ref_proses_pendaftaran
 *
 * @property RefAgen $refAgen
 * @property RefKecamatan $refKecamatan
 * @property RefKelurahan $refKelurahan
 * @property RefProsesPendaftaran $refProsesPendaftaran
 */
class RegistrasiAgen extends \yii\db\ActiveRecord {

    public $username, $password, $cara_daftar, $id_referensi_agen;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'registrasi_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Wajib di isi {attribute}'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 6, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Wajib di isi {attribute}'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required', 'message' => 'Wajib di isi {attribute}'],
            ['password', 'string', 'min' => 6],
            [['nik','id_ref_agen','nope','nama'], 'required', 'message' => 'Wajib di isi {attribute}'],
            [['email'], 'email'],
            [['tgl_registrasi'], 'safe'],
            [['alamat', 'username', 'id_referensi_agen', 'id_kab', 'id_kelurahan', 'id_kecamatan',], 'string'],
            [['id_ref_agen', 'id_ref_proses_pendaftaran', 'cara_daftar'], 'integer'],
            [['no_reg', 'nama', 'rt_rw', 'nope'], 'string'],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
//            [['id_ref_kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => RefKecamatan::className(), 'targetAttribute' => ['id_ref_kecamatan' => 'id']],
//            [['id_ref_kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['id_ref_kelurahan' => 'id']],
            [['id_ref_proses_pendaftaran'], 'exist', 'skipOnError' => true, 'targetClass' => RefProsesPendaftaran::className(), 'targetAttribute' => ['id_ref_proses_pendaftaran' => 'id']],
            ['nik', 'string', 'min' => 16, 'max' => 16, 'message' => 'Panjang harus 16 karakter'],
         ['nik', 'unique',  'message' => 'NIK Sudah digunakan.'],
       ['username', 'match',  'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/', 'message' => 'spasi tidak di izinkan'],
  //     ['password', 'match',  'not' => true, 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => 'spasi tidak di izinkan, kombinasikan hurup, angka, dan simbol'],
             ['nope', 'unique',  'message' => 'No Telp Sudah digunakan.'],
     
                ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'no_reg' => 'NO. REGISTRASI',
            'nik' => 'NIK',
            'nama' => 'NAMA',
            'alamat' => 'ALAMAT',
            'rt_rw' => 'Rt Rw',
            'id_kab' => 'KABUPATEN',
            'id_kelurahan' => 'KELURAHAN',
            'id_kecamatan' => 'KECAMATAN',
            'id_referensi_agen' => 'ID REFERENSI AGEN',
            'nope' => 'NO. TELPON',
            'id_ref_agen' => 'AGEN / KONSUMEN',
            'id_ref_proses_pendaftaran' => 'STATUS PENDAFTARAN',
        ];
    }

    /**
     * Gets query for [[RefAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgen() {
        return $this->hasOne(RefAgen::className(), ['id' => 'id_ref_agen']);
    }

    /**
     * Gets query for [[RefKecamatan]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getRefKecamatan()
//    {
//        return $this->hasOne(RefKecamatan::className(), ['id' => 'id_ref_kecamatan']);
//    }
//
//    /**
//     * Gets query for [[RefKelurahan]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getRefKelurahan()
//    {
//        return $this->hasOne(RefKelurahan::className(), ['id' => 'id_ref_kelurahan']);
//    }

    /**
     * Gets query for [[RefProsesPendaftaran]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProsesPendaftaran() {
        return $this->hasOne(RefProsesPendaftaran::className(), ['id' => 'id_ref_proses_pendaftaran']);
    }

}
