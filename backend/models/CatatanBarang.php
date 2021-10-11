<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "catatan_barang".
 *
 * @property int $id
 * @property int|null $id_ref_barang
 * @property int|null $id_ref_satuan
 * @property int|null $qty
 * @property int|null $id_data_agen
 * @property int|null $id_ref_suplier
 * @property int|null $harga_satuan
 * @property string|null $no_acak
 * @property string|null $tgl_pemesanan
 *
 * @property DataAgen $dataAgen
 * @property RefBarang $refBarang
 * @property RefSatuanBarang $refSatuan
 * @property RefSuplier $refSuplier
 */
class CatatanBarang extends \yii\db\ActiveRecord
{
    public $jumlah;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catatan_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_barang', 'id_ref_satuan', 'qty', 'id_data_agen', 'id_ref_suplier','harga_satuan'], 'required','message'=>'Wajib di isi'],
            [['id_ref_barang', 'id_ref_satuan', 'qty', 'id_data_agen', 'id_ref_suplier','harga_satuan','jumlah'], 'integer'],
            [['tgl_pemesanan'], 'safe'],
            [['no_acak'],'string'],
            [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
            [['id_ref_barang'], 'exist', 'skipOnError' => true, 'targetClass' => RefBarang::className(), 'targetAttribute' => ['id_ref_barang' => 'id']],
            [['id_ref_satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefSatuanBarang::className(), 'targetAttribute' => ['id_ref_satuan' => 'id']],
            [['id_ref_suplier'], 'exist', 'skipOnError' => true, 'targetClass' => RefSuplier::className(), 'targetAttribute' => ['id_ref_suplier' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_barang' => 'Barang',
            'id_ref_satuan' => 'Satuan',
            'qty' => 'Qty',
            'id_data_agen' => 'Agen',
            'id_ref_suplier' => 'Suplier',
            'tgl_pemesanan' => 'Tgl Pemesanan',
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
     * Gets query for [[RefBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefBarang()
    {
        return $this->hasOne(RefBarang::className(), ['id' => 'id_ref_barang']);
    }

    /**
     * Gets query for [[RefSatuan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefSatuan()
    {
        return $this->hasOne(RefSatuanBarang::className(), ['id' => 'id_ref_satuan']);
    }

    /**
     * Gets query for [[RefSuplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefSuplier()
    {
        return $this->hasOne(RefSuplier::className(), ['id' => 'id_ref_suplier']);
    }
    
    public static  function getDataGridviewCatatanBarang($id_data_agen){
        $query = (new \yii\db\Query())
                ->select('a.*,b.selesai')
                ->from('catatan_barang a')
                ->innerJoin('catatan_barang_agen b','a.id_data_agen=b.id_data_agen')
                ->where(['a.id_data_agen'=>$id_data_agen])->groupBy('a.no_acak,a.tgl_pemesanan')->orderBy('a.tgl_pemesanan desc,a.id desc');
        return $query;
    }
    
    public static function getDatabarangAll($no_acak){
        $query = (new \yii\db\Query())
                ->select('a.*,b.kode,b.nama_barang')
                ->from('catatan_barang a')
                ->innerJoin('ref_barang b','a.id_ref_barang=b.id')
                ->where(['a.no_acak'=>$no_acak])->all();
        return $query;
    }
}
