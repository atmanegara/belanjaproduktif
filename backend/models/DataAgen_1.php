<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_agen".
 *
 * @property int $id
 * @property string|null $id_agen
 * @property int|null $id_ref_agen
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
 * @property DataAgenWaris[] $dataAgenWaris
 * @property RefBerkasAgen[] $refBerkasAgens
 */
class DataAgen1 extends \yii\db\ActiveRecord
{
   public $filedok;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_agen', 'nama_agen', 'nik', 'tmpt_lahir', 'pekerjaan', 'rt_domisili', 'rw_domisili','id_ref_agen','id_kab', 'id_kelurahan',
                'id_kecamatan', 'id_ref_status_sipil','id_kab_domisili', 'id_kelurahan_domisili', 'id_kecamatan_domisili'], 'required','message'=>'Wajib di isi {attribute}'],
            [['filedok'],'file','skipOnEmpty'=>true],
            [['id_ref_agen', 'id_ref_status_sipil'], 'integer'],
            [['alamat', 'alamat_domisili','id_kab','id_kelurahan', 'id_kecamatan','id_kab_domisili','id_kelurahan_domisili', 'id_kecamatan_domisili'], 'string'],
            [['tgl_lahir'], 'safe'],
            [['id_agen', 'nama_agen', 'nik', 'tmpt_lahir', 'pekerjaan', 'rt_domisili', 'rw_domisili'], 'string', 'max' => 50],
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
            'id_agen' => 'Id Agen',
            'id_ref_agen' => 'Id Ref Agen',
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

    /**
     * Gets query for [[DataAgenWaris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgenWaris()
    {
        return $this->hasMany(DataAgenWaris::className(), ['id_data_agen' => 'id']);
    }

    /**
     * Gets query for [[RefBerkasAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefBerkasAgens()
    {
        return $this->hasMany(RefBerkasAgen::className(), ['id_data_agen' => 'id']);
    }
    
    public static function dropdownagen(){
        $array = DataAgen::find()->where(['id_ref_agen'=>'1'])->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_agen');
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
    
    public static function getOneRowByNoacak($no_acak){
        $array = DataAgen::find()->where(['no_acak'=>$no_acak])->one();
        return $array;
    }
    
    
    public static function jumAnggotaFix(){
        $jumanggotafix = DataAgen::find()
                ->leftJoin('registrasi_agen','data_agen.no_acak=registrasi_agen.no_acak')
                ->where(['registrasi_agen.id_ref_proses_pendaftaran'=>'2'])
                ->count();
        return $jumanggotafix ? 0 : $jumanggotafix;
    }
    
    public static function jumAnggotaNoFix(){
        $jumanggotanonfix = DataAgen::find()
                ->rightJoin('registrasi_agen','data_agen.no_acak=registrasi_agen.no_acak')
                ->where(['registrasi_agen.id_ref_proses_pendaftaran'=>'1'])
                ->count();
        return $jumanggotanonfix;
    }
}
