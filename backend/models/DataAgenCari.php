<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_agen".
 *
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
 * @property DataBarang[] $dataBarangs
 * @property ProgramAgen[] $programAgens
 * @property StokBarang[] $stokBarangs
 * @property TransaksiKomisi[] $transaksiKomisis
 */
class DataAgenCari extends \yii\db\ActiveRecord
{
  public $filedok,$nama_toko;
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
            [['alamat', 'alamat_domisili'], 'string'],
            [['tgl_lahir'], 'safe'],
            [['no_acak', 'id_agen', 'filename', 'nama_agen', 'nik', 'tmpt_lahir', 'pekerjaan', 'email', 'rt_domisili', 'rw_domisili', 'no_acak_ref'], 'string', 'max' => 50],
            [['rt', 'rw', 'id_kab', 'id_kab_domisili'], 'string'],
            [['id_kelurahan', 'id_kelurahan_domisili'], 'string'],
            [['id_kecamatan', 'id_kecamatan_domisili'], 'string'],
            [['kode_post'], 'string'],
            [['no_wa'], 'string'],
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
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'id_agen' => 'ID AGEN',
            'id_ref_agen' => 'AGEN',
            'filename' => 'Filename',
            'nama_agen' => 'NAMA AGEN',
            'nik' => 'NIK',
            'alamat' => 'ALAMAT',
            'rt' => 'RT',
            'rw' => 'RW',
            'id_kab' => 'KABUPATEN',
            'id_kelurahan' => 'KELURAHAN',
            'id_kecamatan' => 'KECAMATAN',
            'kode_post' => 'KODE POST',
            'tmpt_lahir' => 'TEMPAT LAHIR',
            'tgl_lahir' => 'TANGGAL LAHIR',
            'id_ref_status_sipil' => 'STATUS PERKAWINAN',
            'pekerjaan' => 'PEKERJAAN',
            'no_wa' => 'NOMOR. WA (*Aktif)',
            'email' => 'Email (*Valid)',
            'alamat_domisili' => 'ALAMAT DOMISILI',
            'rt_domisili' => 'RT',
            'rw_domisili' => 'RW',
            'id_kab_domisili' => 'KABUPATEN',
            'id_kelurahan_domisili' => 'KELURAHAN',
            'id_kecamatan_domisili' => 'KECEMATAN',
            'no_acak_ref' => 'No Acak Ref',
        ];
    }
public static function getAgenRefId(){
    $dataAgenId = DataAgen::find()->where('no_acak_ref <> ""')->orWhere(['id_ref_agen'=>['1']])->orWhere(['id_ref_agen'=>['7']])->asArray()->all();
    return \yii\helpers\ArrayHelper::map($dataAgenId,'no_acak',function($model, $defaultValue){
        $namaToko = DataToko::find()->where(['no_acak'=>$model['no_acak']]);
        if($namaToko->exists()){
            $toko = $namaToko->one();
            $namaToko = $toko['nama_toko'];
        }else{
            $namaToko = $model['nama_agen'];
        }
        return $model['id_agen'] .' - '.$namaToko;
    });
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

    /**
     * Gets query for [[DataBarangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataBarangs()
    {
        return $this->hasMany(DataBarang::className(), ['id_data_agen' => 'id']);
    }

    /**
     * Gets query for [[ProgramAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramAgens()
    {
        return $this->hasMany(ProgramAgen::className(), ['id_data_agen' => 'id']);
    }

    /**
     * Gets query for [[StokBarangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStokBarangs()
    {
        return $this->hasMany(StokBarang::className(), ['id_data_agen' => 'id']);
    }
   public function getCatatanBarangs()
    {
        return $this->hasMany(CatatanBarang::className(), ['id_data_agen' => 'id']);
    }
      public static function dropdownagen(){
        $array = DataAgen::find()->asArray()->where(['id_ref_agen'=>'1'])->all();
        return \yii\helpers\ArrayHelper::map($array, 'id',function($model,$attribute){
            return $model['id_agen'].' - '.$model[ 'nama_agen'];
            
        });
    }
     public static function dropdownagenOrder($id_ref_agen){
        $array = DataAgen::find()->asArray()->where(['IN','id_ref_agen',$id_ref_agen])->all();
        return \yii\helpers\ArrayHelper::map($array, 'id',function($model,$attribute){
            return $model['id_agen'].' - '.$model[ 'nama_agen'];
            
        });
    }
        public static function dropdownagenAll(){
        $array = DataAgen::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_agen');
    }
      public static function dropdownagenAllAgen(){
        $array = DataAgen::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'no_acak',function($model,$attribute){
            $refAgen = RefAgen::find()->where(['id'=>$model['id_ref_agen']])->one();
            return '( '.$refAgen['nama_agen'].' ) '. $model['id_agen'].' - '.$model[ 'nama_agen'];
            
        });
    }
      public static function dropdownagenAllNoAcak(){
        $array = DataAgen::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'no_acak', 'nama_agen');
    }
    /**
     * Gets query for [[TransaksiKomisis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKomisis()
    {
        return $this->hasMany(TransaksiKomisi::className(), ['id_data_agen' => 'id']);
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
            $filename = $this->no_acak.'_'.date('YmdHis').'.'.$this->filedok->extension;
            if(empty($this->filename)){
                
            }else{
            $pathfilename= Yii::getAlias('@path_upload/') . $this->filename;
            if(file_exists($pathfilename)){
                unlink($pathfilename);
            }
            }
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
    
    public static function cekIdAgenExists($no_acak){
        $dataAgenExists = DataAgen::find()->where(['no_acak'=>$no_acak])->exists();
        return $dataAgenExists;
    }
    
    public static function ambilNoAcakAgenRefAgen($id_ref_agen){
        return \yii\helpers\ArrayHelper::map(\backend\models\DataAgen::find()->where(['id_ref_agen'=>$id_ref_agen])->asArray()->all(),'no_acak','no_acak');
    }
}
