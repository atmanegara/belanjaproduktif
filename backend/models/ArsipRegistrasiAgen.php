<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "arsip_registrasi_agen".
 *
 * @property int $id
 * @property string $tgl_registrasi
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
 * @property string $tgl_jam
 *
 * @property RefAgen $refAgen
 * @property RefProsesPendaftaran $refProsesPendaftaran
 */
class ArsipRegistrasiAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arsip_registrasi_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_registrasi'], 'required'],
            [['tgl_registrasi', 'tgl_jam'], 'safe'],
            [['alamat', 'setuju'], 'string'],
            [['id_ref_agen', 'id_ref_proses_pendaftaran'], 'integer'],
            [['id_referen_agen', 'no_reg', 'no_acak', 'nik', 'nama', 'nope', 'email'], 'string', 'max' => 50],
            [['rt_rw', 'id_kab'], 'string', 'max' => 11],
            [['id_kelurahan', 'id_kecamatan'], 'string', 'max' => 12],
            [['nik'], 'unique'],
            [['nope'], 'unique'],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
            [['id_ref_proses_pendaftaran'], 'exist', 'skipOnError' => true, 'targetClass' => RefProsesPendaftaran::className(), 'targetAttribute' => ['id_ref_proses_pendaftaran' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_registrasi' => 'Tgl Registrasi',
            'id_referen_agen' => 'Id Referen Agen',
            'no_reg' => 'No Reg',
            'no_acak' => 'No Acak',
            'nik' => 'Nik',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'rt_rw' => 'Rt Rw',
            'id_kab' => 'Id Kab',
            'id_kelurahan' => 'Id Kelurahan',
            'id_kecamatan' => 'Id Kecamatan',
            'nope' => 'Nope',
            'email' => 'Email',
            'id_ref_agen' => 'Id Ref Agen',
            'id_ref_proses_pendaftaran' => 'Id Ref Proses Pendaftaran',
            'setuju' => 'Setuju',
            'tgl_jam' => 'Tgl Jam',
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
