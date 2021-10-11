<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "foto_profil".
 *
 * @property int $id
 * @property string|null $filename
 */
class FotoProfil extends \yii\db\ActiveRecord
{
    public $filedok;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'foto_profil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filedok'],'file','skipOnEmpty'=>false],
            [['filename'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
        ];
    }
    
  
    public function upload(){
        if($this->validate()){
            $filename = date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
}
