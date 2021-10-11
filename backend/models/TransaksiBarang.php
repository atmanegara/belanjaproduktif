<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaksi_barang".
 *
 * @property int $id
 * @property string|null $tgl_transaksi
 * @property int|null $id_data_agen
 * @property int|null $id_data_barang
 * @property int|null $qty
 * @property int|null $duit_tunai
 * @property int|null $duit_kembali
 * @property float|null $harga_satuan
 * @property float|null $margin_item
 * @property float|null $margin_total
 * @property string|null $keterangan
 * @property string|null $barkode
 * @property string|null $kode_barkode
 */
class TransaksiBarang extends \yii\db\ActiveRecord
{
    public $nama_item;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_transaksi'], 'safe'],
            [['id_data_agen','id_data_toko', 'id_data_barang', 'qty'], 'integer'],
            [['harga_satuan','harga_jual','margin_item','margin_total','total_jual','duit_tunai','duit_kembali'], 'number'],
            [['keterangan','barkode','nama_item','no_invoice','no_acak_pembeli','kode_barkode'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl_transaksi' => 'Tgl Transaksi',
            'id_data_agen' => 'Id Data Agen',
            'id_data_barang' => 'Id Data Barang',
            'qty' => 'Qty',
            'harga_satuan' => 'Harga Satuan',
            'keterangan' => 'Keterangan',
        ];
    }
    
    
    public static function getTransaksiBarang($tgl_awal,$tgl_akhir){
        $sql = "SELECT aa.id_data_agen, aa.barkode, e.id as id_data_barang,e.id_ref_barang, a.nama_barang,bc.nama_satuan,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,(b.qty_in-c.qty_out) AS sisa_qty,c.tgl_keluar,
            aa.harga_satuan,(aa.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,b.harga_jual,(c.harga_jual*c.qty_out) total,c.no_acak_pembeli 
            FROM ref_barang a
INNER JOIN data_barang aa ON a.id=aa.id_ref_barang
INNER JOIN ref_satuan_barang bc on aa.id_ref_satuan_barang=bc.id
INNER JOIN data_agen ab ON aa.id_data_agen=ab.id
right JOIN (SELECT aa.tgl_transaksi tgl_masuk,
sum(aa.qty) AS qty_in,aa.harga_jual,bb.id_ref_barang,bb.id_data_agen,aa.no_acak_pembeli FROM transaksi_barang aa 
INNER JOIN data_barang bb ON aa.id_data_barang=bb.id
WHERE aa.keterangan='IN' and aa.tgl_transaksi between :tgl_awal and :tgl_akhir GROUP BY bb.id_ref_barang) b ON a.id=b.id_ref_barang 
AND b.id_data_agen=aa.id_data_agen
LEFT JOIN (SELECT  cc.tgl_transaksi tgl_keluar,
sum(cc.qty) AS qty_out,dd.id_ref_barang,dd.harga_satuan,cc.margin_item,
cc.margin_total,cc.harga_jual,dd.id_data_agen,cc.no_acak_pembeli FROM transaksi_barang cc 
INNER JOIN data_barang dd ON cc.id_data_barang=dd.id 
WHERE cc.keterangan='OUT' and cc.tgl_transaksi between :tgl_awal and :tgl_akhir GROUP BY dd.id_ref_barang) c ON a.id=c.id_ref_barang 
AND c.id_data_agen=aa.id_data_agen
left JOIN atur_margin_item d ON a.id=d.id_ref_barang
left JOIN data_barang e ON e.id_ref_barang=a.id 
LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen ";
        $params=[
            ':tgl_awal'=>$tgl_awal,
            ':tgl_akhir'=>$tgl_akhir
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $query;
    }
    
      public static function getTransaksiBarangAgen($tgl_awal,$tgl_akhir,$no_acak){
        $sql = "SELECT aa.id_data_agen,  aa.barkode, e.id as id_data_barang,e.id_ref_barang, a.nama_barang, bc.nama_satuan,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,(b.qty_in-c.qty_out) AS sisa_qty,c.tgl_keluar,
            aa.harga_satuan,(aa.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,b.harga_jual,(c.harga_jual*c.qty_out) total,c.no_acak_pembeli 
            FROM ref_barang a
INNER JOIN data_barang aa ON a.id=aa.id_ref_barang
INNER JOIN ref_satuan_barang bc on aa.id_ref_satuan_barang=bc.id
INNER JOIN data_agen ab ON aa.id_data_agen=ab.id
right JOIN (SELECT aa.tgl_transaksi tgl_masuk,
sum(aa.qty) AS qty_in,aa.harga_jual,bb.id_ref_barang,bb.id_data_agen,aa.no_acak_pembeli FROM transaksi_barang aa 
INNER JOIN data_barang bb ON aa.id_data_barang=bb.id
WHERE aa.keterangan='IN' and aa.tgl_transaksi between :tgl_awal and :tgl_akhir GROUP BY bb.id_ref_barang) b ON a.id=b.id_ref_barang 
AND b.id_data_agen=aa.id_data_agen
LEFT JOIN (SELECT  cc.tgl_transaksi tgl_keluar,
sum(cc.qty) AS qty_out,dd.id_ref_barang,dd.harga_satuan,cc.margin_item,
cc.margin_total,cc.harga_jual,dd.id_data_agen,cc.no_acak_pembeli FROM transaksi_barang cc 
INNER JOIN data_barang dd ON cc.id_data_barang=dd.id 
WHERE cc.keterangan='OUT' and cc.tgl_transaksi between :tgl_awal and :tgl_akhir GROUP BY dd.id_ref_barang) c ON a.id=c.id_ref_barang 
AND c.id_data_agen=aa.id_data_agen
left JOIN atur_margin_item d ON a.id=d.id_ref_barang
left JOIN data_barang e ON e.id_ref_barang=a.id 
LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen where ab.no_acak=:no_acak";
        $params=[
            ':tgl_awal'=>$tgl_awal,
            ':tgl_akhir'=>$tgl_akhir,
            ':no_acak'=>$no_acak
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $query;
    }
    
    //get stok akhir
    public static function getStokAkhir($no_acak){
        $sql = "SELECT a.barkode,c.kode,a.item_barang,e.stok_sisa stok_sisa,d.nama_satuan,a.harga_satuan,e.harga_jual FROM data_barang a 
left JOIN riwayat_stok_barang b ON b.id_data_barang=a.id AND a.id_data_agen=b.id_data_agen
left join data_agen bb on a.id_data_agen=bb.id
left JOIN ref_barang c ON a.id_ref_barang=c.id
left JOIN ref_satuan_barang d ON a.id_ref_satuan_barang=d.id
left JOIN stok_barang e ON e.id_data_agen=a.id_data_agen AND e.id_data_barang=a.id
WHERE bb.no_acak=:no_acak and a.aktif='Y' 
GROUP BY a.id ORDER BY e.stok_sisa ASC  ";
          $params=[
            ':no_acak'=>$no_acak
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $query;
    } 
    
}
