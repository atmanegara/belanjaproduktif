<?php

namespace backend\controllers;

use Yii;
use backend\models\BookingBarang;
use backend\models\BookingBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TransaksiBarang;

/**
 * BookingBarangController implements the CRUD actions for BookingBarang model.
 */
class BookingBarangController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BookingBarang models.
     * @return mixed
     */
    public function actionIndex($status_booking = 1) {
        $no_acak = Yii::$app->user->identity->no_acak;
        if (!\backend\models\DataAgen::cekIdAgenExists($no_acak)) {
            //     Yii::$app->session->setFlash('danger','Pastikan anda sudah mengisi data pribadi');
            return $this->redirect(['/site/data-agen-exists']);
        }
        //  if(!$status_booking){
        //       $status_booking = 1;
        //  }
        $query = BookingBarang::modelDataBookingStatus($no_acak, $status_booking);
        $totalBookingProsess = BookingBarang::modelDataBookingCount($no_acak);
        $totalBookingSelesai = BookingBarang::modelDataBookingCount($no_acak, 2);
        $totalBookingBatal = BookingBarang::modelDataBookingCount($no_acak, 0);
//        $searchModel = new BookingBarangSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', [
//            'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'totalBookingProsess' => $totalBookingProsess,
                    'totalBookingSelesai' => $totalBookingSelesai,
                    'totalBookingBatal' => $totalBookingBatal
        ]);
    }

    /**
     * Displays a single BookingBarang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BookingBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new BookingBarang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing BookingBarang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BookingBarang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteAll($kd_booking) {
        BookingBarang::deleteAll(['kd_booking' => $kd_booking]);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the BookingBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BookingBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = BookingBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLampiranToko($no_invoice, $kd_booking) {
        $checkOutModel = \backend\models\CheckoutItem::find()->where(['no_invoice' => $no_invoice])
                ->innerJoin('data_barang','checkout_item.id_data_barang=data_barang.id')
                ->all();
        $dataCehckOut = \backend\models\CheckoutItem::find()->where(['no_invoice' => $no_invoice])->one();
        $modelBooking = \backend\models\BookingBarang::find()->where(['kd_booking' => $kd_booking])->one();
        $dataAgenPembeli = \backend\models\DataAgen::find()->where(['no_acak' => $dataCehckOut['no_acak']])->one();
        return $this->render('lampiran-toko', [
                    'model' => $checkOutModel, 'no_invoice' => $no_invoice, 'modelBooking' => $modelBooking, 'kd_booking' => $kd_booking, 'dataAgenPembeli' => $dataAgenPembeli
        ]);
    }

    public function actionPrintLampiranToko($no_invoice, $kd_booking, $export) {
        $checkOutModel = \backend\models\CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        $dataCehckOut = \backend\models\CheckoutItem::find()->where(['no_invoice' => $no_invoice])->one();
        $modelBooking = \backend\models\BookingBarang::find()->where(['kd_booking' => $kd_booking])->one();
        $dataAgenPembeli = \backend\models\DataAgen::find()->where(['no_acak' => $dataCehckOut['no_acak']])->one();
        $content = $this->renderPartial('lampiran-toko', [
            'model' => $checkOutModel, 'no_invoice' => $no_invoice, 'modelBooking' => $modelBooking, 'kd_booking' => $kd_booking, 'dataAgenPembeli' => $dataAgenPembeli
        ]);
        $filename = $no_invoice . '_' . $kd_booking;

        if ($export == 'pdf') {
            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
            Yii::$app->response->headers->add('Content-Type', 'application/pdf');
            $pdf = new \kartik\mpdf\Pdf();
            $mpdf = $pdf->api;
            $mpdf->WriteHtml($content);
            return $mpdf->Output($filename . '.pdf', 'I');
        } elseif ($export == 'xls') {

            header("Content-type: application/vnd.ms-excel");
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
            return $content;
        }

        return $mpdf->Output($filename, 'I');
    }

    public function actionKonfirmasiBooking($no_invoice, $kd_booking) {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataAgenModel = \backend\models\DataAgen::findOne(['no_acak' => $no_acak]);
        $model = \backend\models\BookingBarang::find()->where(['kd_booking' => $kd_booking])->one();
        $modelTotalInvoice = \backend\models\CheckoutItem::total($no_invoice);
        $no_invoicelama = '';
        if ($model->load(Yii::$app->request->post())) {
            $status_booking = $model->status_booking;
            //  
            $modelBooking = \backend\models\BookingBarang::find()->where(['kd_booking' => $kd_booking])->all();
            foreach ($modelBooking as $val) {

                $no_invoice = $val['no_invoice'];
                $id = $val['id'];
                $modelData = $this->findModel($id);
                $modelData->isNewRecord = false;
                $modelData->status_booking = $status_booking;
                $modelData->save(false);

//                if ($model->status_booking == '0') {//batal
////                    $stokBarang = \backend\models\StokBarang::findOne($val['id_stok_barang']);
////                    $stokBarang->isNewRecord = false;
////                    $stok_awal = $stokBarang->stok_awal;
////                    $stokBarang->stok_awal = $stok_awal + $val['qty_keluar'];
////                    $stokBarang->save(false);
//
//                          BookingBarang::updateAll(['status_booking'=>'0'],['kd_posting'=>$kd_booking]);
//                } else
                    if ($model->status_booking == '2') {//seelsai
                    //     $stokBarangModel = \backend\models\StokBarang::findOne($val['id_stok_barang']);
                    if ($no_invoicelama != $no_invoice) {
                        $dataItem = \backend\models\CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
                        foreach ($dataItem as $valueItem) {
                            $no_invoicex = $valueItem['no_invoice'];
                            $no_acak_pembeli = $valueItem['no_acak'];
                            $margin_item = 0;
                                $margin_total = 0;
                                $harga_jual =0;
                                
                            $stokBarang = \backend\models\StokBarang::find()->where([
                                'id_data_barang' => $valueItem['id_data_barang']]);
                            if ($stokBarang->exists()) {
                                //data Barang
                                $databarang = \backend\models\DataBarang::findOne($valueItem['id_data_barang']);
                                $id_ref_barang = $databarang['id_ref_barang'];
                                $stokBarang = $stokBarang->one();
                                $stok_sisa_sebelumnya = $stokBarang->stok_sisa;
                                $stokBarang->isNewRecord = false;
                                $stokBarang->stok_akhir = \backend\models\StokBarang::getJlhQty($databarang['id_data_agen'], $valueItem['id_data_barang']) + $valueItem['qty'];
                                $stokBarang->stok_sisa = \backend\models\StokBarang::getSisaQty($databarang['id_data_agen'], $valueItem['id_data_barang']) - $valueItem['qty'];
                                //     $stokBarang->stok_awal = \backend\models\StokBarang::getQty($databarang['id_data_agen'], $valueItem['id_data_barang']) - $valueItem['qty'];
                                $stokBarang->save(false);

                                $modelRiwayatStokbarang = new \backend\models\RiwayatStokBarang();
                                $modelRiwayatStokbarang->isNewRecord = true;
                                $modelRiwayatStokbarang->id = null;
                                $modelRiwayatStokbarang->barkode = $stokBarang->barkode;
                                $modelRiwayatStokbarang->id_data_agen = $dataAgenModel['id'];
                                $modelRiwayatStokbarang->id_data_barang = $valueItem['id_data_barang'];
                                $modelRiwayatStokbarang->stok_awal = $stok_sisa_sebelumnya;
                                $modelRiwayatStokbarang->stok_akhir = $valueItem['qty'];
                                $modelRiwayatStokbarang->stok_sisa = $stokBarang->stok_sisa;
                                $modelRiwayatStokbarang->no_invoice = $no_invoicex;
                                $modelRiwayatStokbarang->save(false);
                                //masuk transaksi
                                $transaksiBarangModel = new TransaksiBarang();
                                $databarang = \backend\models\DataBarang::findOne($valueItem['id_data_barang']);
   //cek barang ditoko siapa
                $dataToko = \backend\models\DataToko::find()->where(['id_data_agen'=>$databarang['id_data_agen']])->one();
            
                                $cekmargin = \backend\models\AturMarginItem::find()->where([
                                    'id_ref_barang' => $databarang['id_ref_barang']])
                                        ->andWhere('harga_satuan IS NOT NULL');
  //                                      ->one();
                                if($cekmargin->exists()){
                                    $margin = $cekmargin->one();
                                    
                                        $persen_margin = ($margin['nilai'] / 100);
                                $margin_item = $databarang['harga_satuan'] * $persen_margin;
                                $margin_total = $valueItem['qty'] * $margin_item;
                                $harga_jual = $margin_item + $databarang['harga_satuan'];
                                }
                                $transaksiBarangModel->no_invoice = $no_invoicex;
                                $transaksiBarangModel->nama_item = $databarang['item_barang'];
                                $transaksiBarangModel->id_data_agen = $dataAgenModel['id'];
                                $transaksiBarangModel->id_data_barang = $databarang['id'];
                                $transaksiBarangModel->id_data_toko=$dataToko['id'];
                                $transaksiBarangModel->barkode = $databarang['barkode'];
                                $transaksiBarangModel->margin_item = $margin_item;
                                $transaksiBarangModel->duit_tunai = $model->duit_tunai;
                                $transaksiBarangModel->duit_kembali = $model->duit_kembali;
                                $transaksiBarangModel->harga_jual = $harga_jual;
                                $transaksiBarangModel->harga_satuan = $databarang['harga_satuan'];
                                $transaksiBarangModel->qty = $valueItem['qty'];
                                $transaksiBarangModel->margin_total = $margin_total;
                                $total_jual = $valueItem['qty'] * $harga_jual;
                                $transaksiBarangModel->total_jual = $total_jual;
                                $transaksiBarangModel->tgl_transaksi = $valueItem['tgl_masuk'];// date('Y-m-d');
                                $transaksiBarangModel->keterangan = 'OUT';
                                $transaksiBarangModel->no_acak_pembeli = $valueItem['no_acak'];
                                $transaksiBarangModel->save(false);

                                //     $detailDataAgen = \backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak])->all(); //\frontend\models\DataDetailAgen::find()->where(['no_acak_referensi'=>$dataAgen['no_acak']])->all();//dicek pakai agen promo
//                        $detailDataAgen = \backend\models\DataAnggota::find()->where(['no_acak_agen' => $no_acak])->all(); //\frontend\models\DataDetailAgen::find()->where(['no_acak_referensi'=>$dataAgen['no_acak']])->all();//dicek pakai agen promo
//
//                        foreach ($detailDataAgen as $valPasok) {
//                            $no_acak_pemberi = $valueItem['no_acak'];
//                            $dataAgenPasok = \backend\models\DataAgen::find()->where(['no_acak' => $valPasok['no_acak']]);
//                            if ($dataAgenPasok->exists()) {
//                                $dataAgenPasok = $dataAgenPasok->one();
//                                $cekItem = \backend\models\DataItemBarangAgen::find()->where(['id_ref_barang' => $id_ref_barang, 'no_acak' => $dataAgenPasok['no_acak']]);
//                                if ($cekItem->exists()) {
//                                    $aturBagiHasilJualItem = \backend\models\AturBagiHasilJualItem::find()->where(['id_ref_agen' => '2'])->one();
//                                    $transaksiKomisi = new \backend\models\TransaksiKomisi();
//                                    $transaksiKomisi->isNewRecord = true;
//                                    $transaksiKomisi->id = null;
//                                    $transaksiKomisi->no_acak_pemberi = $no_acak_pemberi;
//                                    $transaksiKomisi->no_acak = $dataAgenPasok['no_acak'];
//                                    $transaksiKomisi->tgl_masuk = date('Y-m-d');
//                                    $transaksiKomisi->id_data_agen = $dataAgenPasok['id'];
//                                    //        $jumlah_bagi_hasil = $margin_item * $valueItem['qty'];
//                                    $transaksiKomisi->jumlah = $total_jual;
//                                    $transaksiKomisi->nilai_bagi = $aturBagiHasilJualItem['nilai'];
//                                    $nominal = $total_jual * ($aturBagiHasilJualItem['nilai'] / 100);
//                                    $transaksiKomisi->nominal = $nominal;
//                                    $transaksiKomisi->ket = 2;
//                                    $transaksiKomisi->tahun = date('Y');
//                                    $transaksiKomisi->save(false);
//                                    ///insert data komisi
//                                    $modelKomisiAgen = \backend\models\DataKomisi::find()->where(['no_acak' => $dataAgenPasok['no_acak']]);
//                                    $nominalOld = 0;
//                                    if ($modelKomisiAgen->exists()) {
//                                        $modelKomisi = $modelKomisiAgen->one();
//                                        $nominalOld = $modelKomisi['nominal'];
//                                    } else {
//                                        $modelKomisi = new \backend\models\DataKomisi();
//                                    }
//                                    $modelKomisi->nominal = $nominal + $nominalOld;
//                                    $modelKomisi->no_acak = $dataAgenPasok['no_acak'];
//                                    $modelKomisi->id_data_agen = $dataAgenPasok['id'];
//                                    $modelKomisi->ket = 2;
//                                    $modelKomisi->tgl_transaksi = date('Y-m-d');
//                                    $modelKomisi->save(false);
//                                }
//                            }
//                        }
                                //      }
                            }
                        }
                    }
                }
                $no_invoicelama = $no_invoice;
            }
//            if ($model->status_booking == '0') {
//
//                BookingBarang::deleteAll(['kd_booking' => $kd_booking]);
//            }
            $model->save();
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
                    'modelTotalInvoice' => $modelTotalInvoice,
            'kd_booking'=>$kd_booking
        ]);
    }
    public function actionBatalBooking($kd_booking){

//                    $stokBarang = \backend\models\StokBarang::findOne($val['id_stok_barang']);
//                    $stokBarang->isNewRecord = false;
//                    $stok_awal = $stokBarang->stok_awal;
//                    $stokBarang->stok_awal = $stok_awal + $val['qty_keluar'];
//                    $stokBarang->save(false);

                          BookingBarang::updateAll(['status_booking'=>'0'],['kd_booking'=>$kd_booking]);
         return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionPrintThermalFaktur($no_invoice) {
        $no_acak = Yii::$app->user->identity->no_acak;
        $dataItem = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->all();
        $dataItemPembayaran = CheckoutItem::find()->where(['no_invoice' => $no_invoice])->one();
        $detailPembayaran = DetailPembayaran::find()->where(['no_invoice' => $no_invoice])->one();
        $dataToko = \backend\models\DataToko::find()
                        ->innerJoin('data_agen', 'data_toko.id_data_agen=data_agen.id')
                        ->where(['data_agen.no_acak' => $no_acak])->one();
        return $this->renderPartial('print-thermal-faktur', [
                    'dataItem' => $dataItem,
                    'detailPembayaran' => $detailPembayaran,
                    'dataToko' => $dataToko
        ]);
    }

}
