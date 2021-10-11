<?php
namespace frontend\models;
use Yii;

use yii\db\Query;

class QueryModel extends \yii\db\ActiveRecord
{
    
//    public static function getDataBarangAll(){
//        $dataBarang=(new Query())
//        ->select('a.id,a.filename,a.item_barang,b.stok_sisa,c.harga_satuan,c.harga_jual')
//        ->from('data_barang a')
//        ->innerJoin('stok_barang b','a.id=b.id_data_barang')
//        ->innerJoin('transaksi_barang c','c.id_data_barang=b.id_data_barang')->groupBy('a.id_data_agen,a.id'); //->all()
//    return $dataBarang;
//    }
    public static function getDataBarangAll(){
            $dataBarang=(new Query())
        ->select('b.id,a.filename,a.nama_barang AS item_barang,c.stok_sisa,c.harga_jual,b.id_data_agen,d.nama_toko')
        ->from('ref_barang a')
        ->leftJoin('data_barang b','a.id=b.id_ref_barang')
        ->leftJoin('stok_barang c','c.id_data_barang=b.id')
                    ->leftJoin('data_toko d','d.id_data_agen=b.id_data_agen')
                    ->where(['a.tampil'=>'Y']);//->groupBy('a.id_data_agen,a.id'); //->all()
    return $dataBarang;    
    }
    public static function getDataBarangLimit($limit){
 $dataBarang=(new Query())
        ->select('b.id,a.filename,a.nama_barang AS item_barang,c.stok_sisa,c.harga_jual,b.id_data_agen,b.ket,b.harga_satuan')
        ->from('ref_barang a')
        ->leftJoin('data_barang b','a.id=b.id_ref_barang')
        ->leftJoin('stok_barang c','c.id_data_barang=b.id')->where(['a.tampil'=>'Y'])->groupBy('a.kode')->limit($limit)->orderBy('c.harga_jual desc')->all();
        return $dataBarang;
    }
    
    public static function getDataBarangHot(){
        //max 6 item
 $dataBarang=(new Query())
        ->select('b.id,a.filename,a.nama_barang AS item_barang,c.stok_sisa,c.harga_jual,b.id_data_agen,b.ket,b.harga_satuan')
        ->from('ref_barang a')
        ->leftJoin('data_barang b','a.id=b.id_ref_barang')
         ->innerJoin('barang_hot bb','a.id=bb.id_ref_barang')
        ->leftJoin('stok_barang c','c.id_data_barang=b.id')->where(['a.tampil'=>'Y'])->groupBy('a.kode')->limit(6)->orderBy('c.harga_jual desc')->all();
        return $dataBarang;
        
    }
    
     public static function getDataBarangAllByFilter($id_kab,$id_kecamatan,$id_kelurahan,$nama_item){
        $dataBarang=(new Query())
        ->select('b.id,a.filename,a.nama_barang AS item_barang,c.stok_sisa,c.harga_jual,b.id_data_agen,b.ket,b.harga_satuan,e.nama_toko')
        ->from('ref_barang a')
        ->leftJoin('data_barang b','a.id=b.id_ref_barang')
        ->leftJoin('stok_barang c','c.id_data_barang=b.id')
                ->leftJoin('data_agen d','b.id_data_agen=d.id')
                ->leftJoin('data_toko e','e.id_data_agen=d.id')
                ->where(['a.tampil'=>'Y'])
                ->andFilterWhere(['like','a.nama_barang',$nama_item])
        ->orFilterWhere(['like', 'd.id_kab', $id_kab])
            ->orFilterWhere(['like', 'd.id_kecamatan', $id_kecamatan])
            ->orFilterWhere(['like', 'd.id_kelurahan', $id_kelurahan]);
               // ->groupBy('a.id_data_agen,a.id'); //->all()
    return $dataBarang;
    }
      public static function getDataBarangAllByFilterIdAgen($id_data_agen,$nama_item){
        $dataBarang=(new \yii\db\Query())
        ->select('a.id,a.filename,bb.kode_barcode,a.item_barang,b.tgl_masuk,b.stok_sisa,dd.nama_satuan,c.harga_satuan,b.harga_jual,d.nama_toko')
        ->from('data_barang a')
     ->leftJoin('data_toko d','d.id_data_agen=a.id_data_agen')
     ->innerJoin('ref_satuan_barang dd','dd.id=a.id_ref_satuan_barang')
        ->innerJoin('stok_barang b','a.id=b.id_data_barang')
                ->innerJoin('ref_barang bb','a.id_ref_barang=bb.id')
        ->innerJoin('transaksi_barang c','c.id_data_barang=b.id_data_barang')->where("a.id_data_agen IN ($id_data_agen)")
                ->andWhere(['a.aktif'=>'Y'])
                ->andWhere(['LIKE','a.item_barang',$nama_item])
                ->orWhere(['=','bb.kode_barcode',$nama_item])
                ->orWhere(['=','bb.kode',$nama_item])
                ->groupBy('a.id_data_agen,a.id');
    return $dataBarang;
    
     }
//         public static function getDataBarangAllByFilterIdAgen($id_data_agen,$nama_item){
//        $dataBarang=(new Query())
//        ->select('b.id,a.filename,a.nama_barang AS item_barang,c.tgl_masuk,c.stok_sisa,c.harga_jual,b.id_data_agen,b.ket,b.harga_satuan,f.nama_toko')
//        ->from('ref_barang a')
//        ->leftJoin('data_barang b','a.id=b.id_ref_barang')
//        ->leftJoin('stok_barang c','c.id_data_barang=b.id')
//                ->leftJoin('data_toko f','b.id_data_agen=f.id_data_agen')
//                ->leftJoin('data_agen d','b.id_data_agen=d.id')
//                ->where(['a.tampil'=>'Y','d.id'=>$id_data_agen])
//                ->andFilterWhere(['like','a.nama_barang',$nama_item]);
//               // ->groupBy('a.id_data_agen,a.id'); //->all()
//    return $dataBarang;
//    }
    public static function getDetailItemNoInvoice($no_invoice){
        $data = \backend\models\CheckoutItem::findAll(['no_invoice'=>$no_invoice]);
        return $data;
    }
    
    public static function getTotalAgenToko(){
        $totalAgen = \backend\models\DataAgen::find()->count();
        $totalToko = \backend\models\DataToko::find()->innerJoin('data_agen','data_toko.id_data_agen=data_agen.id')->count();
        return [
            'totalAgen'=>$totalAgen,
            'totalToko'=>$totalToko
        ];
    }
}

