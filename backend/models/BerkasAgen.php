<?php

namespace backend\models;

use Yii;
use yii\db\Query;
/**
 * This is the model class for table "berkas_agen".
 *
 * @property int $id
 * @property string|null $id_agen
 * @property int|null $id_data_agen
 * @property int|null $id_ref_jenis_dok
 * @property string|null $filename
 *
 * @property DataAgen $dataAgen
 * @property RefJenisDok $refJenisDok
 */
class BerkasAgen extends \yii\db\ActiveRecord
{
    public $filebukti;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'berkas_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filebukti'],'file','skipOnEmpty'=>false],
            [['id_data_agen', 'id_ref_jenis_dok'], 'integer'],
            [['id_agen', 'filename'], 'string'],
     //       [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
            [['id_ref_jenis_dok'], 'exist', 'skipOnError' => true, 'targetClass' => RefJenisDok::className(), 'targetAttribute' => ['id_ref_jenis_dok' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_agen' => 'ID Agen',
            'id_data_agen' => 'Agen',
            'id_ref_jenis_dok' => 'Jenis Dok',
            'filename' => 'File name',
        ];
    }

    /**
     * Gets query for [[DataAgen]].
     *
     * @return \yii\db\ActiveQuery
     */

    /**
     * Gets query for [[RefJenisDok]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisDok()
    {
        return $this->hasOne(RefJenisDok::className(), ['id' => 'id_ref_jenis_dok']);
    }
    public function upload(){
        if($this->validate()){
            //   foreach($this->filebuktias $filedoknya){
            $filename = $this->id_data_agen.'_'. date('YmdHis').'.'.$this->filebukti->extension;
            $this->filename = $filename;
            $this->filebukti->saveAs(Yii::getAlias('@path_upload/').$filename);
            //       }
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
            $filename = $this->id_data_agen.'_'. date('YmdHis').'.'.$this->filebukti->extension;
            $this->filename = $filename;
            $this->filebukti->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
    
    public static function dataProviderQuery($id_data_agen){
////        $sql="SELECT b.id,b.nama_dok FROM berkas_agen a
////INNER JOIN ref_jenis_dok b ON a.id_ref_jenis_dok=b.id
////WHERE a.id_data_agen=8
////UNION ALL
////SELECT c.id,c.nama_dok FROM ref_jenis_dok c
////WHERE c.id NOT IN (SELECT b.id FROM berkas_agen a
////INNER JOIN ref_jenis_dok b ON a.id_ref_jenis_dok=b.id
////WHERE a.id_data_agen=8)";
//        
//        
//        $query1 = (new \yii\db\Query())
//                ->select('a.id,b.id AS id_ref_jenis_dok,b.nama_dok,a.filename')->from('berkas_agen a')->innerJoin('ref_jenis_dok b','a.id_ref_jenis_dok=b.id')
//                ->where(['a.id_data_agen'=>$id_data_agen]);
//  
//         $select1 = (new \yii\db\Query())
//                ->select('b.id')->from('berkas_agen a')->innerJoin('ref_jenis_dok b','a.id_ref_jenis_dok=b.id')
//                ->where(['a.id_data_agen'=>$id_data_agen]);
//  
//         
//        $query2=(new Query())
//                ->select('d.id,c.id AS id_ref_jenis_dok,c.nama_dok,d.filename')->from('ref_jenis_dok c')
//                ->leftJoin('berkas_agen d','c.id=d.id_ref_jenis_dok')
//                ->where(['NOT IN','c.id',$select1]);
        $array = (new Query())
                ->select('a.nama_dok,c.filename,a.id as id_ref_jenis_dok,c.id')
                ->from('ref_jenis_dok a')
                ->innerJoin('data_agen b','a.id_ref_agen=b.id_ref_agen')
                ->leftJoin('berkas_agen c','b.id=c.id_data_agen AND c.id_ref_jenis_dok=a.id')->where(['b.id'=>$id_data_agen]);
        return $array;
    }
}
