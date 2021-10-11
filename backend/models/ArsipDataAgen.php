<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "arsip_data_agen".
 *
 * @property string $no_acak_arsip
 * @property string $tgl_berhenti
 * @property string $alasan
 * @property int $id
 * @property string $no_acak
 * @property string|null $id_agen
 * @property int|null $id_ref_agen
 * @property string|null $filename
 * @property string|null $nama_agen
 * @property string|null $nik
 * @property string|null $alamat
 * @property string|null $rt
 * @property string|null $rw
 * @property string|null $id_kab
 * @property string|null $id_kelurahan
 * @property string|null $id_kecamatan
 * @property string|null $kode_post
 * @property string|null $tmpt_lahir
 * @property string|null $tgl_lahir
 * @property int|null $id_ref_status_sipil
 * @property string|null $pekerjaan
 * @property string|null $no_wa
 * @property string|null $email
 * @property string|null $alamat_domisili
 * @property string|null $rt_domisili
 * @property string|null $rw_domisili
 * @property string|null $id_kab_domisili
 * @property string|null $id_kelurahan_domisili
 * @property string|null $id_kecamatan_domisili
 * @property string|null $no_acak_ref
 *
 * @property Kabupaten $kab
 * @property Kabupaten $kabDomisili
 * @property Kecamatan $kecamatan
 * @property Kecamatan $kecamatanDomisili
 * @property Kelurahan $kelurahan
 * @property Kelurahan $kelurahanDomisili
 * @property RefAgen $refAgen
 * @property RefStatusSipil $refStatusSipil
 */
class ArsipDataAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'arsip_data_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_acak_arsip', 'tgl_berhenti', 'id'], 'required'],
            [['tgl_berhenti', 'tgl_lahir'], 'safe'],
            [['id', 'id_ref_agen', 'id_ref_status_sipil'], 'integer'],
            [['alamat', 'alamat_domisili'], 'string'],
            [['no_acak_arsip', 'alasan', 'no_acak', 'id_agen', 'filename', 'nama_agen', 'nik', 'tmpt_lahir', 'pekerjaan', 'email', 'rt_domisili', 'rw_domisili', 'no_acak_ref'], 'string', 'max' => 50],
            [['rt', 'rw', 'id_kab', 'id_kab_domisili'], 'string', 'max' => 4],
            [['id_kelurahan', 'id_kecamatan', 'id_kelurahan_domisili', 'id_kecamatan_domisili'], 'string', 'max' => 10],
            [['kode_post'], 'string', 'max' => 7],
            [['no_wa'], 'string', 'max' => 20],
            [['nik'], 'unique'],
            [['no_acak_arsip', 'id'], 'unique', 'targetAttribute' => ['no_acak_arsip', 'id']],
            [['id_kab'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['id_kab' => 'id_kab']],
            [['id_kab_domisili'], 'exist', 'skipOnError' => true, 'targetClass' => Kabupaten::className(), 'targetAttribute' => ['id_kab_domisili' => 'id_kab']],
            [['id_kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['id_kecamatan' => 'id_kec']],
            [['id_kecamatan_domisili'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['id_kecamatan_domisili' => 'id_kec']],
            [['id_kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['id_kelurahan' => 'id_kel']],
            [['id_kelurahan_domisili'], 'exist', 'skipOnError' => true, 'targetClass' => Kelurahan::className(), 'targetAttribute' => ['id_kelurahan_domisili' => 'id_kel']],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
            [['id_ref_status_sipil'], 'exist', 'skipOnError' => true, 'targetClass' => RefStatusSipil::className(), 'targetAttribute' => ['id_ref_status_sipil' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_acak_arsip' => 'No Acak Arsip',
            'tgl_berhenti' => 'Tgl Berhenti',
            'alasan' => 'Alasan',
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'id_agen' => 'Id Agen',
            'id_ref_agen' => 'Id Ref Agen',
            'filename' => 'Filename',
            'nama_agen' => 'Nama Agen',
            'nik' => 'Nik',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'id_kab' => 'Id Kab',
            'id_kelurahan' => 'Id Kelurahan',
            'id_kecamatan' => 'Id Kecamatan',
            'kode_post' => 'Kode Post',
            'tmpt_lahir' => 'Tmpt Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'id_ref_status_sipil' => 'Id Ref Status Sipil',
            'pekerjaan' => 'Pekerjaan',
            'no_wa' => 'No Wa',
            'email' => 'Email',
            'alamat_domisili' => 'Alamat Domisili',
            'rt_domisili' => 'Rt Domisili',
            'rw_domisili' => 'Rw Domisili',
            'id_kab_domisili' => 'Id Kab Domisili',
            'id_kelurahan_domisili' => 'Id Kelurahan Domisili',
            'id_kecamatan_domisili' => 'Id Kecamatan Domisili',
            'no_acak_ref' => 'No Acak Ref',
        ];
    }

    /**
     * Gets query for [[Kab]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKab()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kab' => 'id_kab']);
    }

    /**
     * Gets query for [[KabDomisili]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKabDomisili()
    {
        return $this->hasOne(Kabupaten::className(), ['id_kab' => 'id_kab_domisili']);
    }

    /**
     * Gets query for [[Kecamatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kec' => 'id_kecamatan']);
    }

    /**
     * Gets query for [[KecamatanDomisili]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatanDomisili()
    {
        return $this->hasOne(Kecamatan::className(), ['id_kec' => 'id_kecamatan_domisili']);
    }

    /**
     * Gets query for [[Kelurahan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahan()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kel' => 'id_kelurahan']);
    }

    /**
     * Gets query for [[KelurahanDomisili]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKelurahanDomisili()
    {
        return $this->hasOne(Kelurahan::className(), ['id_kel' => 'id_kelurahan_domisili']);
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
     * Gets query for [[RefStatusSipil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusSipil()
    {
        return $this->hasOne(RefStatusSipil::className(), ['id' => 'id_ref_status_sipil']);
    }
}
