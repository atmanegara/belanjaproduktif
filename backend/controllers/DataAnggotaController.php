<?php
namespace backend\controllers;

use Yii;
use backend\models\DataAnggota;
use backend\models\DataAnggotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataAnggotaController implements the CRUD actions for DataAnggota model.
 */
class DataAnggotaController extends Controller {

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
     * Lists all DataAnggota models.
     * @return mixed
     */
    public function actionIndex() {

        $no_acak_agen = Yii::$app->user->identity->no_acak;
        $dataAgen = \backend\models\DataAgen::find()->where(['no_acak' => $no_acak_agen])->one();
        if (!\backend\models\DataAgen::cekIdAgenExists($no_acak_agen)) {
            //     Yii::$app->session->setFlash('danger','Pastikan anda sudah mengisi data pribadi');
            return $this->redirect(['/site/data-agen-exists']);
        }

        $searchModel = new DataAnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak_agen' => $no_acak_agen]);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_agen' => $dataAgen['id_agen']
        ]);
    }

    public function actionIndexAgen($id_ref_agen) {
        //       $searchModel = new DataAnggotaSearch();
        //    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = DataAnggota::dataAnggotaByRefAgen($id_ref_agen);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
                'key'=>'id'
        ]);
        return $this->render('index-agen', [
                    //        'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetailAnggota($no_acak_agen) {
        $dataAgen = \backend\models\DataAgen::findOne(['no_acak' => $no_acak_agen]);
        $searchModel = new DataAnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['no_acak_agen' => $no_acak_agen]);
        return $this->render('index_1', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id_ref_agen' => $dataAgen['id_ref_agen']
        ]);
    }

    /**
     * Displays a single DataAnggota model.
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
     * Creates a new DataAnggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DataAnggota();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataAnggota model.
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
     * Deletes an existing DataAnggota model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($no_acak) {
       // $this->findModel($id)->delete();
       DataAnggota::find()->where([
           'no_acak'=>$no_acak
       ])->one()->delete();
       
        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionDeleteId($id) {
     $model = $this->findModel($id);
     $no_acak = $model['no_acak'];  
     $model->delete();
     \backend\models\RegistrasiAgen::deleteAll(['no_acak'=>$no_acak]);
     \backend\models\KonfirmasiPembayaran::deleteAll(['no_acak'=>$no_acak]);
     \backend\models\User::deleteAll(['no_acak'=>$no_acak]);
     \backend\models\ArsipRegistrasiAgen::deleteAll(['no_acak'=>$no_acak]);
        return $this->redirect(Yii::$app->request->referrer);
    }
    /**
     * Finds the DataAnggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataAnggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DataAnggota::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrintData($no_acak) {
        $query = \common\models\User::find()->where(['no_acak' => $no_acak])->one();
        $queryAnggota = DataAnggota::find()->where(['no_acak' => $no_acak])->one();
        $queryReg = \backend\models\RegistrasiAgen::find()->where(['no_acak' => $no_acak])->one();
        $filename = $no_acak . '.pdf';
        $content = $this->renderPartial('print-data', [
            'query' => $query,
            'queryAnggota' => $queryAnggota,
            'queryReg' => $queryReg
        ]);


        $pdf = new \kartik\mpdf\Pdf();
        $mpdf = $pdf->api;
        $mpdf->WriteHtml($content);
        return $mpdf->Output($filename, 'I');
    }

}
