<?php

namespace backend\controllers;

use Yii;
use backend\models\RefBarang;
use backend\models\RefBarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * RefBarangController implements the CRUD actions for RefBarang model.
 */
class RefBarangController extends Controller {

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
     * Lists all RefBarang models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RefBarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefBarang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->renderAjax('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefBarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new RefBarang();

        if ($model->load(Yii::$app->request->post())) {
            //     $model->filedok = \yii\web\UploadedFile::getInstance($model, 'filedok');
            //    if($model->upload()){
            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }

            //   }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing RefBarang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //  $model->filedok = \yii\web\UploadedFile::getInstance($model, 'filedok');
            //   if($model->reupload()){
            if ($model->save()) {
                //data barang
                $modelDataBarangcek = \backend\models\DataBarang::find()->where(['id_ref_barang' => $id]);
                if ($modelDataBarangcek->exists()) {
                    $modelDataBarang = \backend\models\DataBarang::updateAll([
                                'item_barang' => $model->nama_barang,
                                'kode_barcode' => $model->kode_barcode
                                    ], [
                                'id_ref_barang' => $id
                    ]);
//                $modelDataBarang = $modelDataBarangcek->one();
//                $modelDataBarang->item_barang = $model->nama_barang;
//                    $modelDataBarang->kode_barcode = $model->kode_barcode;
//                $modelDataBarang->save(false);
                }
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
            //      }
        }

        return $this->renderAjax('_form', [
                    'model' => $model,
        ]);
    }

    public function actionUpdateGambar($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->filedok = \yii\web\UploadedFile::getInstance($model, 'filedok');
            if ($model->reupload()) {
                if ($model->save()) {
                    $modelDataBarangcek = \backend\models\DataBarang::find()->where(['id_ref_barang' => $id]);
                    if ($modelDataBarangcek->exists()) {
                        $modelDataBarang = \backend\models\DataBarang::updateAll([
                                    'filename' => $model->filename
                                        ], [
                                    'id_ref_barang' => $id
                        ]);
                        //  $modelDataBarang->filename = $model->filename;
                        //   $modelDataBarang->save(false);
                    }

                    return $this->redirect(Yii::$app->request->referrer);
                }
            } else {

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return \kartik\form\ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('_form_file', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RefBarang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $cekCheckout = \backend\models\CheckoutItem::find()
                ->innerJoin('data_barang', 'data_barang.id=checkout_item.id_data_barang')
                ->where(['data_barang.id_ref_barang' => $id]);
        if ($cekCheckout->exists()) {
            Yii::$app->session->setFlash('danger', 'Item Barang tidak bisa dihapus,Hanya bisa di 0 Kan saja Stoknya / tidak dipilih dalam pesanan barang ke toko');
        } else {
            $this->findModel($id)->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the RefBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefBarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RefBarang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBarangList($q = null, $id = null) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = (new \yii\db\Query());
            $query->select(['id,concat(kode_barcode," - ",nama_barang) AS text'])
                    ->from('ref_barang')
                    ->where(['like', 'nama_barang', $q])
                    ->orFilterWhere(['LIKE', 'kode_barcode', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => City::find($id)->name];
        }
        return $out;
    }

    public function actionTemplateRefBarang() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID (JANGAN DIGANTI)');
        $sheet->setCellValue('C1', 'Kode Barang Lama (JANGAN DIGANTI) ');
        $sheet->setCellValue('D1', 'Kode Barcode Lama (JANGAN DIGANTI)');
        $sheet->setCellValue('E1', 'Kode Barang Baru');
        $sheet->setCellValue('F1', 'Kode Barcode Baru');
        $sheet->setCellValue('G1', 'Nama Barang');
        $sheet->setCellValue('H1', 'Margin Item (%)');
        $sheet->setCellValue('I1', 'Harga Satuan');
//ref barang
        $query = (new \yii\db\Query())
                        ->select('a.id,a.kode,a.kode_barcode,a.nama_barang,b.nilai AS margin_item,b.harga_satuan')
                        ->from('ref_barang a')
                        ->leftJoin('atur_margin_item b', 'a.id=b.id_ref_barang')->all();
        $i = 2;
        $no = 1;

        foreach ($query as $row) {
            $sheet->setCellValue('A' . $i, $no++);
            $sheet->setCellValue('B' . $i, $row['id']);
            $sheet->setCellValue('C' . $i, $row['kode']);
            $sheet->setCellValue('D' . $i, $row['kode_barcode']);
            $sheet->setCellValue('E' . $i, "");
            $sheet->setCellValue('F' . $i, "");
            $sheet->setCellValue('G' . $i, $row['nama_barang']);
            $sheet->setCellValue('H' . $i, $row['margin_item']);
            $sheet->setCellValue('I' . $i, $row['harga_satuan']);
            $i++;
        }
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $i = $i - 1;
        $sheet->getStyle('A1:I' . $i)->applyFromArray($styleArray);


        $writer = new Xlsx($spreadsheet);
        $filename = Yii::getAlias('@path_upload/') . 'Report Data Siswa.xlsx';
        $writer->save($filename);
        if (file_exists($filename)) {
            return Yii::$app->response->sendFile($filename, 'template_excel_ref_barang');
        }
    }

    public function actionImportRefBarang() {
        $model = new RefBarang();
        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = \yii\web\UploadedFile::getInstance($model, 'filedok');
            $extension = $uploadedFile->extension;
            if ($extension == 'xlsx') {
                $inputFileType = 'Xlsx';
            } else {
                $inputFileType = 'Xls';
            }
            $sheetname = 'Worksheet';
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

            $reader->setLoadSheetsOnly($sheetname);

            $spreadsheet = $reader->load($uploadedFile->tempName);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

//inilah looping untuk membaca cell dalam file excel,perkolom

            for ($row = 2; $row <= $highestRow; ++$row) { //$row = 2 artinya baris kedua yang dibaca dulu(header kolom diskip disesuaikan saja)
//for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $id = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); //3 artinya kolom ke3
                $kode_lama = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); //3 artinya kolom ke3
                $kode_barkode_lama = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); // 10 artinya kolom 10
                $kode = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); // 10 artinya kolom 10
                $kode_barkode = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); // 10 artinya kolom 10
                $nama_barang = $worksheet->getCellByColumnAndRow(7, $row)->getValue(); // 10 artinya kolom 10
                $margin_item = $worksheet->getCellByColumnAndRow(8, $row)->getValue(); // 10 artinya kolom 10
                $harga_satuan = $worksheet->getCellByColumnAndRow(9, $row)->getValue(); // 10 artinya kolom 10
//cek ref_barang
                $modelCekRefBarang = RefBarang::find()->where([
                    'id'=>$id
                ]);
                if($modelCekRefBarang->exists()){
                    $modelRefBarang = $modelCekRefBarang->one();
                    $modelRefBarang->isNewRecord=false;
                }else{
                    $modelRefBarang = new RefBarang();
                    $modelRefBarang->isNewRecord=true;
                    $modelRefBarang->id=null;
                }
                if($kode_barkode==''){
                    $kode_barkode = $kode_barkode_lama;
                }
                if($kode==''){
                    $kode=$kode_lama;
                }
                $modelRefBarang->kode = $kode;
                $modelRefBarang->kode_barcode = $kode_barkode;
                $modelRefBarang->nama_barang = $nama_barang;
                $modelRefBarang->tampil='Y';
                $modelRefBarang->save(false);
                $idRefBarang = $modelRefBarang->getPrimaryKey();
                //cek atur margin
                 $modelCekMargin = \backend\models\AturMarginItem::find()->where([
                    'id_ref_barang'=>$id
                ]);
                if($modelCekMargin->exists()){
                    $modelMarginItem = $modelCekMargin->one();
                    $modelMarginItem->isNewRecord=false;
                }else{
                    $modelMarginItem = new \backend\models\AturMarginItem();
                    $modelMarginItem->isNewRecord=true;
                    $modelMarginItem->id=null;
                    $modelMarginItem->id_ref_barang=$idRefBarang;
                }
                $modelMarginItem->nilai = $margin_item;
                $modelMarginItem->harga_satuan = $harga_satuan;
                $modelMarginItem->save(false);
            }
            Yii::$app->session->setFlash('success','Selesai');
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        return $this->renderAjax('import-ref-barang',[
            'model'=>$model
        ]);
    }

}
