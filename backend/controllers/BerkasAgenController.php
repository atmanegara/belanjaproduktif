<?php

namespace backend\controllers;

use Yii;
use backend\models\BerkasAgen;
use backend\models\BerkasAgenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\bootstrap4\ActiveForm;
use yii\web\Response;
use backend\models\RefJenisDok;
use backend\models\RegistrasiAgen;
use backend\models\DataAgen;

/**
 * BerkasAgenController implements the CRUD actions for BerkasAgen model.
 */
class BerkasAgenController extends Controller
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
     * Lists all BerkasAgen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_data_agen='';
        $role_id = Yii::$app->user->identity->role_id;
        
        $searchModel = new BerkasAgenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $no_acak = Yii::$app->request->get('no_acak');
        if(!$no_acak){
            $no_acak = Yii::$app->user->identity->no_acak;
           
        }
        $dataAgen = DataAgen::find()->where(['no_acak'=>$no_acak])->one();
        $id_data_agen = $dataAgen['id'];
        $dataProvider->query->where(['id_data_agen'=>$id_data_agen]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           'id_data_agen'=>$id_data_agen,
            'no_acak'=>$no_acak
        ]);
    }

    /**
     * Displays a single BerkasAgen model.
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
     * Creates a new BerkasAgen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_data_agen,$no_acak,$id_ref_jenis_dok)
    {
        $model = new BerkasAgen();
        $model->id_data_agen= $id_data_agen;
        $model->no_acak = $no_acak;
//    $modelRefJnsDok= RefJenisDok::DropDownList();
    $model->id_ref_jenis_dok=$id_ref_jenis_dok;
        if ($model->load(Yii::$app->request->post()) ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->filebukti = UploadedFile::getInstance($model, 'filebukti');
            
            if($model->upload()){
                
            if($model->save(false)){
                   
                return $this->redirect(Yii::$app->request->referrer);
                }
            }else{
                return ActiveForm::validate($model);
            }
        }
            
          

        return $this->renderAjax('_form', [
            'model' => $model,
  //          'modelRefJnsDok'=>$modelRefJnsDok
        ]);
    }

    /**
     * Updates an existing BerkasAgen model.
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
     * Deletes an existing BerkasAgen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $berkas = $this->findModel($id);
        $no_acak = $berkas['no_acak'];
        $filename = $berkas['filename'];
          $pathfilename = Yii::getAlias('@path_upload/') . $filename;
            if (file_exists($pathfilename)) {
                unlink($pathfilename);
                
            }
            $berkas->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the BerkasAgen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BerkasAgen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BerkasAgen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionTampilDok($id){
        $file_berkas = BerkasAgen::find()->where(['id'=>$id])->one();
        return $this->renderAjax('tampil-dok',[
            'file_berkas'=>$file_berkas
        ]);
    }
    

}
