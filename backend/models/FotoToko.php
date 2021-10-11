<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "foto_toko".
 *
 * @property int $id
 * @property int|null $id_data_toko
 * @property string|null $filename
 */
class FotoToko extends \yii\db\ActiveRecord
{
    public $filedok;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'foto_toko';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          [['filedok'],'file','skipOnEmpty'=>true],
              [['id'], 'required'],
            [['id', 'id_data_toko'], 'integer'],
            [['filename'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_toko' => 'Id Data Toko',
            'filename' => 'Filename',
        ];
    }
    
       public function upload(){
        if($this->validate()){
            $filename = $this->no_acak.'_'.date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
    public function reupload(){
        if($this->validate()){
            if(!empty($this->filename)){
                
            
            $pathfilename= Yii::getAlias('@path_upload/') . $this->filename;
            if(file_exists($pathfilename)){
                unlink($pathfilename);
            }
            }
            $filename = $this->id_data_toko.'_'.date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
}
