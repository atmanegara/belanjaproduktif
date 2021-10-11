<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_barang".
 *
 * @property int $id
 * @property int|null $id_data_agen
 * @property string|null $item_barang
 * @property int|null $id_ref_satuan_barang
 *
 * @property DataAgen $dataAgen
 * @property RefSatuanBarang $refSatuanBarang
 * @property StokBarang[] $stokBarangs
 */
class DataBarang extends \yii\db\ActiveRecord
{
    
    public $qty,$filedok,$bykagen,$alasan;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filedok'],'file','skipOnEmpty'=>false,'extensions'=>'jpg,png,jpeg','on'=>'create'],
            [[ 'id_ref_satuan_barang','qty','harga_satuan','item_barang','barkode','filedok'], 'required','message'=>'Wajib Di isi','on'=>'create'],
            [['id_data_agen', 'id_ref_satuan_barang','qty','harga_satuan'], 'integer'],
            [['item_barang','barkode','filename','alasan'], 'string', 'max' => 160],
            [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
            [['id_ref_satuan_barang'], 'exist', 'skipOnError' => true, 'targetClass' => RefSatuanBarang::className(), 'targetAttribute' => ['id_ref_satuan_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_agen' => 'Agen',
            'item_barang' => 'Item Barang',
            'id_ref_satuan_barang' => 'Satuan',
        ];
    }

    /**
     * Gets query for [[DataAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgen()
    {
        return $this->hasOne(DataAgen::className(), ['id' => 'id_data_agen']);
    }

    /**
     * Gets query for [[RefSatuanBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefSatuanBarang()
    {
        return $this->hasOne(RefSatuanBarang::className(), ['id' => 'id_ref_satuan_barang']);
    }

    
    /**
     * Gets query for [[StokBarangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStokBarangs()
    {
        return $this->hasOne(StokBarang::className(), ['id_data_barang' => 'id']);
    }
    
    public function upload(){
        if($this->validate()){
            $filename = $this->barkode.'_'.date('YmdHis').'.'.$this->filedok->extension;
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
            $filename = $this->barkode.'_'.date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
    
     public static function getDataBarangAllByIdAgen($id_data_agen){
        $dataBarang=(new \yii\db\Query())
        ->select('a.id,a.filename,bb.kode_barcode,a.item_barang,b.tgl_masuk,b.stok_sisa,c.harga_satuan,dd.nama_satuan,b.harga_jual,d.nama_toko')
        ->from('data_barang a')
     ->leftJoin('data_toko d','d.id_data_agen=a.id_data_agen')
     ->innerJoin('ref_satuan_barang dd','dd.id=a.id_ref_satuan_barang')
        ->innerJoin('stok_barang b','a.id=b.id_data_barang')
                ->innerJoin('ref_barang bb','a.id_ref_barang=bb.id')
        ->innerJoin('transaksi_barang c','c.id_data_barang=b.id_data_barang')->where("a.id_data_agen IN ($id_data_agen)")
                ->andWhere(['a.aktif'=>'Y'])
                ->groupBy('a.id_data_agen,a.id');
    return $dataBarang;
    
     }
     
     public static function  getDataBarangByAgenTurunan($no_acak){
         $dataBarang = (new \yii\db\Query())
                 ->select('d.kode, d.nama_barang,d.filename,d.id as id_ref_barang,c.id')->from('data_agen a')
                 ->innerJoin('data_barang c','a.id=c.id_data_agen')
                 ->innerJoin('ref_barang d','c.id_ref_barang=d.id')->where(['a.no_acak'=>$no_acak]);
         return $dataBarang;
     }
     
     public static function getCountItem($no_acak){
         $query = DataBarang::find()
                 ->alias('a')
                 ->innerJoin('data_agen b','a.id_data_agen=b.id')
                 ->where(['b.no_acak'=>$no_acak])->count();
         return $query;
     }
}
