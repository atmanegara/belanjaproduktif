<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_agen_pasok".
 *
 * @property int $id
 * @property string $no_acak
 * @property string $no_acak_ref
 * @property string|null $id_agen
 * @property int|null $id_ref_agen
 * @property string|null $filename
 * @property string|null $nama_agen
 * @property string|null $nik
 * @property string|null $alamat
 * @property string|null $rt
 * @property string|null $rw
 * @property int|null $id_ref_kelurahan
 * @property int|null $id_ref_kecamatan
 * @property string|null $kode_post
 * @property string|null $tmpt_lahir
 * @property string|null $tgl_lahir
 * @property int|null $id_ref_status_sipil
 * @property string|null $pekerjaan
 * @property string|null $no_wa
 * @property string|null $alamat_domisili
 * @property string|null $rt_domisili
 * @property string|null $rw_domisili
 * @property int|null $id_ref_kecamatan_domisili
 *
 * @property RefAgen $refAgen
 * @property RefKecamatan $refKecamatan
 * @property RefKecamatan $refKecamatanDomisili
 * @property RefKelurahan $refKelurahan
 * @property RefStatusSipil $refStatusSipil
 */
class DataAgenPasok extends \yii\db\ActiveRecord
{
    public $filedok;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_agen_pasok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filedok'],'file','skipOnEmpty'=>false],
            [['id_ref_agen', 'id_ref_kelurahan', 'id_ref_kecamatan', 'id_ref_status_sipil', 'id_ref_kecamatan_domisili'], 'integer'],
            [['alamat', 'alamat_domisili'], 'string'],
            [['tgl_lahir'], 'safe'],
            [['no_acak', 'id_agen', 'filename', 'nama_agen', 'nik', 'tmpt_lahir', 'pekerjaan', 'rt_domisili', 'rw_domisili','no_acak_ref'], 'string', 'max' => 50],
            [['rt', 'rw'], 'string', 'max' => 4],
            [['kode_post'], 'string', 'max' => 7],
            [['no_wa'], 'string', 'max' => 20],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
            [['id_ref_kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => RefKecamatan::className(), 'targetAttribute' => ['id_ref_kecamatan' => 'id']],
            [['id_ref_kecamatan_domisili'], 'exist', 'skipOnError' => true, 'targetClass' => RefKecamatan::className(), 'targetAttribute' => ['id_ref_kecamatan_domisili' => 'id']],
            [['id_ref_kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['id_ref_kelurahan' => 'id']],
            [['id_ref_status_sipil'], 'exist', 'skipOnError' => true, 'targetClass' => RefStatusSipil::className(), 'targetAttribute' => ['id_ref_status_sipil' => 'id']],
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
            'id_agen' => 'Id Agen',
            'id_ref_agen' => 'Id Ref Agen',
            'filename' => 'Filename',
            'nama_agen' => 'Nama Agen',
            'nik' => 'Nik',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'id_ref_kelurahan' => 'Id Ref Kelurahan',
            'id_ref_kecamatan' => 'Id Ref Kecamatan',
            'kode_post' => 'Kode Post',
            'tmpt_lahir' => 'Tmpt Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'id_ref_status_sipil' => 'Id Ref Status Sipil',
            'pekerjaan' => 'Pekerjaan',
            'no_wa' => 'No Wa',
            'alamat_domisili' => 'Alamat Domisili',
            'rt_domisili' => 'Rt Domisili',
            'rw_domisili' => 'Rw Domisili',
            'id_ref_kecamatan_domisili' => 'Id Ref Kecamatan Domisili',
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
     * Gets query for [[RefKecamatan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKecamatan()
    {
        return $this->hasOne(RefKecamatan::className(), ['id' => 'id_ref_kecamatan']);
    }

    /**
     * Gets query for [[RefKecamatanDomisili]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKecamatanDomisili()
    {
        return $this->hasOne(RefKecamatan::className(), ['id' => 'id_ref_kecamatan_domisili']);
    }

    /**
     * Gets query for [[RefKelurahan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelurahan()
    {
        return $this->hasOne(RefKelurahan::className(), ['id' => 'id_ref_kelurahan']);
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
    public function upload(){
        if($this->validate()){
            $filename = $this->no_acak.'_'.date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
    public function reupload(){
        if($this->validate()){
            
            $pathfilename= Yii::getAlias('@path_upload/') . $this->filename;
            if(file_exists($pathfilename)){
                unlink($pathfilename);
            }
            $filename = $this->no_acak.'_'.date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
}
