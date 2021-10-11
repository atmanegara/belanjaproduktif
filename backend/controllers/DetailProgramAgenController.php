<?php

namespace backend\controllers;

use Yii;
use backend\models\DetailProgramAgen;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DetailProgramAgenController implements the CRUD actions for DetailProgramAgen model.
 */
class DetailProgramAgenController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all DetailProgramAgen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => DetailProgramAgen::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetailProgramAgen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DetailProgramAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $modelCek = DetailProgramAgen::find()->where(['id_program_agen'=>$id]);
        if($modelCek->exists()){
         $model = $modelCek->one();   
        }else{
        $model = new DetailProgramAgen();
        }
$model->id_program_agen = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           $dataprogram = \backend\models\ProgramAgen::findOne($id);
           $id_ref_agen= $dataprogram->dataAgen->id_ref_agen;
           $no_acak = $dataprogram->dataAgen->no_acak;
           $no_acak_pemberi = $no_acak;
           $id_referen_agen = \frontend\models\DataDetailAgen::find()->where(['no_acak'=>$no_acak])->one();
         $no_acak_penerima='';
         $id_agen_penerima='';
           if($id_referen_agen['id_referensi_agen']=='0'){
             $no_acak_penerima ='0';
         $id_agen_penerima ='99';
           }else{
           $dataAgenpenerima = \backend\models\DataAgen::find()->where(['id_agen'=>$id_referen_agen['id_referensi_agen']])->one();
         $no_acak_penerima = $dataAgenpenerima['no_acak'];
         $id_agen_penerima = $dataAgenpenerima['id'];
           }
           if($model->aktif=='Y'){
                $aturbagihasilprogram = \backend\models\AturBagiHasilProgram::findOne(['id_ref_agen'=>$id_ref_agen]);
                $nominalbagihasil = $aturbagihasilprogram['nominal'];
                $jumlah = $nominalbagihasil;
                $nilai_bagi =1;
                $nominal = 1*$jumlah;
                $ket = 3;
                if(\backend\models\QueryModel::insertKomisi($id_agen_penerima, $no_acak_penerima, $no_acak_pemberi, $jumlah, $nilai_bagi, $nominal, $ket)){
                    
            return $this->redirect(Yii::$app->request->referrer);
                }
            }
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);
    }
public function actionDetailProgramAgen($id){
    
        $query = DetailProgramAgen::find()->where(['id_program_agen'=>$id]);
        
        $dataProvider = new ActiveDataProvider([
            'query'=>$query
        ]);
        return $this->renderAjax('detail-program-agen',[
            'dataProvider'=>$dataProvider
        ]);
}
    /**
     * Updates an existing DetailProgramAgen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DetailProgramAgen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DetailProgramAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DetailProgramAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DetailProgramAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
