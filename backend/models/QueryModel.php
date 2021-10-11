<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use backend\models\DataKomisi;
use backend\models\TransaksiKomisi;
use backend\models\User;

class QueryModel extends ActiveRecord {

    public static function noacak() {
        $awal = date('YmdHis');
        $akhir = date('siHdmY');
        return (string) rand($awal, $akhir);
    }

    public static function noinvoice() {
        $awal = date('Yds');
        $akhir = date('sdY');
        return rand($awal, $akhir);
    }

    public static function countCod($no_acak) {
        $modelToko = (new Query())
                        ->select('a.id id_data_toko')
                        ->from('data_toko a')
                        ->innerJoin('data_agen b', 'a.id_data_agen=b.id')
                        ->where(['b.no_acak' => $no_acak])->one();

        $dataCheckOutItem = (new Query())
                        ->select(['b.no_invoice,sum(b.total) sum_total,b.no_acak,b.tgl_masuk,a.id_status_pembayaran,d.id_metode_pembayaran,c.status_pembayaran,e.status_pesanan_kurir,e.id_data_kurir,e.id as id_detail_kurir'])
                        ->from('pembayaran_jualbeli a')
                        ->rightJoin('checkout_item b', 'a.no_invoice=b.no_invoice')
                        ->leftJoin('status_pembayaran c', 'a.id_status_pembayaran=c.id')
                        ->leftJoin('detail_pembayaran d', 'b.no_invoice=d.no_invoice')
                        ->leftJoin('detail_pembayaran_kurir e', 'd.no_invoice=e.no_invoice')
                        ->groupBy('b.no_invoice')
                        ->where(['d.id_metode_pembayaran' => 2, 'a.id_status_pembayaran' => '3', 'b.id_data_toko' => $modelToko['id_data_toko']])->count();
        return $dataCheckOutItem;
    }

    public static function insertKomisi($id_data_agen, $no_acak, $no_acak_pemberi, $jumlah, $nilai_bagi, $nominal, $ket) {
        $modelTransaksiKomisi = new TransaksiKomisi();
        $modelTransaksiKomisi->id_data_agen = $id_data_agen;
        $modelTransaksiKomisi->no_acak = QueryModel::noacak();
        $modelTransaksiKomisi->no_acak_pemberi = $no_acak_pemberi;
        $modelTransaksiKomisi->no_acak_penerima = $no_acak;
        $modelTransaksiKomisi->tgl_masuk = date('Y-m-d');
        $modelTransaksiKomisi->jumlah = $jumlah;
        $modelTransaksiKomisi->nilai_bagi = $nilai_bagi;  //persen
        $modelTransaksiKomisi->nominal = $nominal; // membagian hasil;
        $modelTransaksiKomisi->ket = $ket;
        $modelTransaksiKomisi->tahun = date('Y');
        if ($modelTransaksiKomisi->save(false)) {
            $modelKomisi = DataKomisi::find()->where(['no_acak' => $no_acak]);
            if ($modelKomisi->exists()) {
                $modelKomisi = $modelKomisi->one();
            } else {
                $modelKomisi = new DataKomisi();
            }
            $modelKomisi->no_acak = $no_acak;
            $modelKomisi->tgl_transaksi = date('Y-m-d');
            $modelKomisi->id_data_agen = $id_data_agen;
            $modelKomisi->nominal = DataKomisi::getNominal($no_acak) + $nominal;
            $modelKomisi->ket = $ket;
            $modelKomisi->save(false);
            return true;
        } else {
            return false;
        }
    }

    public static function geProgressPersenProgram($no_acak) {
        $query = (new \yii\db\Query())
                        ->select(['b.nama_program,b.biaya,c.nominal,(c.nominal/b.biaya)*100 AS persen'])
                        ->from('program_agen a')
                        ->innerJoin('ref_program_agen b', 'a.id_ref_program_agen=b.id')
                        ->innerJoin('data_komisi c', 'a.no_acak=c.no_acak')
                        ->where([
                            'a.no_acak' => $no_acak
                        ])->one();
        return $query;
    }

    public static function getTransaksiPenjualan($no_acak, $id_data_agen) {
        $sql = "SELECT e.id as id_data_barang,c.no_invoice,ac.no_acak AS no_acak_agen_promo,e.id_ref_barang, e.item_barang as nama_barang,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,c.stok_sisa AS sisa_qty,c.tgl_keluar,
            c.harga_satuan,(c.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,c.harga_jual,(c.harga_jual*c.qty_out) total,
            c.no_acak_pembeli ,ab.no_acak_ref,h.tgl_invoice tgl_transaksi,g.id_data_agen,
						MAX(case when CAST(g.nilai_bagi*100 AS INT)=25 then (c.margin_item*c.qty_out)*(25/100) END) nominal1,
				max(case when CAST(g.nilai_bagi*100 AS INT)=18 then (c.margin_item*c.qty_out)*(18/100) END) nominal2,
				max(case when CAST(g.nilai_bagi*100 AS INT)=7 then (c.margin_item*c.qty_out)*(7/100) END) nominal3
            FROM ref_barang a
INNER JOIN data_barang aa ON a.id=aa.id_ref_barang
LEFT JOIN (SELECT aa.no_acak,aa.tgl_masuk tgl_masuk,
aa.stok_awal AS qty_in,bb.id_ref_barang,bb.id_data_agen,'' AS no_acak_pembeli  FROM arsip_stok_barang aa
left JOIN arsip_data_barang bb ON aa.id_data_barang=bb.id and aa.no_acak=bb.no_acak
WHERE aa.no_acak=:no_acak ) b ON a.id=b.id_ref_barang
AND b.id_data_agen=aa.id_data_agen
right JOIN (SELECT cc.no_acak,cc.no_invoice, aa.tgl_masuk as tgl_keluar,
aa.stok_akhir AS qty_out,aa.stok_sisa,dd.id_ref_barang,cc.harga_satuan,cc.margin_item,
cc.margin_total,cc.harga_jual,dd.id_data_agen,cc.no_acak_pembeli,cc.tgl_transaksi FROM arsip_transaksi_barang cc
INNER JOIN arsip_data_barang dd ON cc.id_data_barang=dd.id  AND cc.no_acak=dd.no_acak
 left JOIN riwayat_stok_barang aa ON aa.no_invoice=cc.no_invoice aND cc.id_data_agen=aa.id_data_agen AND cc.id_data_barang=aa.id_data_barang
WHERE cc.keterangan='OUT'  and cc.no_acak=:no_acak
AND dd.no_acak=:no_acak GROUP BY cc.no_invoice,dd.id_ref_barang,dd.id_data_agen,cc.no_acak_pembeli) c ON a.id=c.id_ref_barang
AND c.id_data_agen=aa.id_data_agen
left JOIN atur_margin_item d ON a.id=d.id_ref_barang
left JOIN arsip_data_barang e ON e.id_ref_barang=c.id_ref_barang  AND e.id_data_agen=c.id_data_agen
LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen
INNER JOIN data_agen ab ON b.no_acak_pembeli=ab.no_acak or c.no_acak_pembeli=ab.no_acak
left JOIN data_agen ac ON aa.id_data_agen=ac.id
left JOIN transaksi_komisi g ON g.id_data_barang=aa.id AND g.no_acak=:no_acak
left join arsip_checkout_item h on h.no_invoice=c.no_invoice and h.no_acak_arsip=c.no_acak
WHERE (e.no_acak=:no_acak  and b.no_acak=:no_acak and c.id_data_agen=:id_data_agen and c.no_acak=:no_acak ) or ( e.no_acak=:no_acak and c.no_acak=:no_acak)
GROUP BY  c.no_invoice,c.id_ref_barang,c.id_data_agen,c.no_acak_pembeli order by h.tgl_invoice,c.no_invoice DESC ";
        $params = [
            ':no_acak' => $no_acak,
            ':id_data_agen' => $id_data_agen
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $query;
    }

    public static function getTransaksiPenjualanold($no_acak, $id_data_agen) {
        $sql = "SELECT e.id as id_data_barang,ac.no_acak AS no_acak_agen_promo,e.id_ref_barang, a.nama_barang,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,(b.qty_in-c.qty_out) AS sisa_qty,c.tgl_keluar,
            c.harga_satuan,(c.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,c.harga_jual,(c.harga_jual*c.qty_out) total,c.no_acak_pembeli ,ab.no_acak_ref
            FROM ref_barang a
INNER JOIN data_barang aa ON a.id=aa.id_ref_barang
LEFT JOIN (SELECT aa.no_acak,aa.tgl_masuk tgl_masuk,
aa.stok_awal AS qty_in,bb.id_ref_barang,bb.id_data_agen,'' AS no_acak_pembeli  FROM arsip_stok_barang aa
left JOIN arsip_data_barang bb ON aa.id_data_barang=bb.id
WHERE aa.no_acak=:no_acak AND bb.no_acak=:no_acak and bb.id_data_agen=:id_data_agen ) b ON a.id=b.id_ref_barang
AND b.id_data_agen=aa.id_data_agen
LEFT JOIN (SELECT cc.no_acak, cc.tgl_transaksi tgl_keluar,
sum(cc.qty) AS qty_out,dd.id_ref_barang,dd.harga_satuan,cc.margin_item,
cc.margin_total,cc.harga_jual,dd.id_data_agen,cc.no_acak_pembeli FROM arsip_transaksi_barang cc
INNER JOIN arsip_data_barang dd ON cc.id_data_barang=dd.id
WHERE cc.keterangan='OUT'  and dd.id_data_agen=:id_data_agen and cc.no_acak=:no_acak
AND dd.no_acak=:no_acak GROUP BY dd.id_ref_barang,dd.id_data_agen,cc.no_acak_pembeli) c ON a.id=c.id_ref_barang
AND c.id_data_agen=aa.id_data_agen
left JOIN atur_margin_item d ON a.id=d.id_ref_barang
left JOIN arsip_data_barang e ON e.id_ref_barang=a.id  AND e.id_data_agen=aa.id_data_agen
LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen
INNER JOIN data_agen ab ON b.no_acak_pembeli=ab.no_acak or c.no_acak_pembeli=ab.no_acak
INNER JOIN data_agen ac ON aa.id_data_agen=ac.id
WHERE (e.no_acak=:no_acak  and b.no_acak=:no_acak) or ( e.no_acak=:no_acak and c.no_acak=:no_acak) order by e.id asc ";
        $params = [
            ':no_acak' => $no_acak,
            ':id_data_agen' => $id_data_agen
        ];
        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
        return $query;
    }

//    public static function getTransaksiPenjualan($no_acak,$id_data_agen){
//        $sql = "SELECT e.id as id_data_barang,e.id_ref_barang, a.nama_barang,f.nama_toko,b.tgl_masuk,b.qty_in,c.qty_out,(b.qty_in-c.qty_out) AS sisa_qty,c.tgl_keluar,
//            c.harga_satuan,(c.harga_satuan*b.qty_in) harga_modal,d.nilai,c.margin_item,c.margin_total,c.harga_jual,(c.harga_jual*c.qty_out) total,c.no_acak_pembeli ,ab.no_acak_ref
//            FROM ref_barang a
//INNER JOIN data_barang aa ON a.id=aa.id_ref_barang
//LEFT JOIN (SELECT aa.no_acak,aa.tgl_transaksi tgl_masuk,
//sum(aa.qty) AS qty_in,bb.id_ref_barang,bb.id_data_agen,aa.no_acak_pembeli FROM arsip_transaksi_barang aa
//INNER JOIN arsip_data_barang bb ON aa.id_data_barang=bb.id
//WHERE aa.keterangan='IN' and bb.id_data_agen=:id_data_agen and aa.no_acak=:no_acak
//AND bb.no_acak=:no_acak GROUP BY bb.id_ref_barang,bb.id_data_agen,aa.no_acak_pembeli) b ON a.id=b.id_ref_barang
//AND b.id_data_agen=aa.id_data_agen
//LEFT JOIN (SELECT cc.no_acak, cc.tgl_transaksi tgl_keluar,
//sum(cc.qty) AS qty_out,dd.id_ref_barang,dd.harga_satuan,cc.margin_item,
//cc.margin_total,cc.harga_jual,dd.id_data_agen,cc.no_acak_pembeli FROM arsip_transaksi_barang cc
//INNER JOIN arsip_data_barang dd ON cc.id_data_barang=dd.id
//WHERE cc.keterangan='OUT'  and dd.id_data_agen=:id_data_agen and cc.no_acak=:no_acak
//AND dd.no_acak=:no_acak GROUP BY dd.id_ref_barang,dd.id_data_agen,cc.no_acak_pembeli) c ON a.id=c.id_ref_barang
//AND c.id_data_agen=aa.id_data_agen
//left JOIN atur_margin_item d ON a.id=d.id_ref_barang
//left JOIN arsip_data_barang e ON e.id_ref_barang=a.id  AND e.id_data_agen=aa.id_data_agen
//LEFT JOIN data_toko f ON e.id_data_agen=f.id_data_agen
//INNER JOIN data_agen ab ON b.no_acak_pembeli=ab.no_acak or c.no_acak_pembeli=ab.no_acak
//WHERE (e.no_acak=:no_acak  and b.no_acak=:no_acak) or ( e.no_acak=:no_acak and c.no_acak=:no_acak) order by e.id asc ";
//        $params=[
//            ':no_acak'=>$no_acak,
//            ':id_data_agen'=>$id_data_agen
//        ];
//        $query = Yii::$app->db->createCommand($sql, $params)->queryAll();
//        return $query;
//    }

    public function getCountAnggotaByPromo($no_acak) {
        $detailDataAgen = \frontend\models\DataDetailAgen::find()->where(['no_acak_referensi' => $no_acak]); //dicek pakai agen promo semuanya
        if ($detailDataAgen->exists()) {
            $countDrPromo = $detailDataAgen->count();
        }
    }

    public static function komisiAgen($no_acak) {
        $dataKomisi = DataKomisi::find()->where(['no_acak' => $no_acak])->one();
        return $dataKomisi;
    }

    public static function saldoAgen($no_acak) {
        $dataSaldo = DataSaldo::find()->where(['no_acak' => $no_acak])->one();
        return $dataSaldo;
    }

    public static function filterIdAgen($nama_agen) {
        $count = DataAgen::find()->where(["like", 'id_agen', $nama_agen])->max('id');
        return $count;
    }

    public static function kirimEmail($no_acak) {
        /* @var $user User */
        $user = (new Query())
                        ->select('a.nik,a.nama,a.alamat,a.nope,b.username,b.password_string,aa.nik as nik_ref,aa.nama_agen as nama_ref,aa.alamat as alamat_ref,aa.no_wa as nope_ref')
                        ->from('registrasi_agen a')
                        ->innerJoin('data_agen aa', 'aa.id_agen=a.id_referen_agen')
                        ->innerJoin('user b', 'a.no_acak=b.no_acak')->where(['b.no_acak' => $no_acak])->one();
        ////User::find()->where(['no_acak'=>$no_acak])->one();
//if($user['email']){
//    $email_to = $user['email'];
//}else{
//    //kosong emailnya
//}
        $tentangKami = TentangKami::find()->one();
        $email_to = $tentangKami['email'];

        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                                ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => 'Admin Belanja Produktif'])
                        ->setTo($email_to)
                        ->setSubject('[ ' . $user['nik'] . ' ] Data Akun Anggota Agen Belanja Produkti')
                        ->send();
    }

}
?>

