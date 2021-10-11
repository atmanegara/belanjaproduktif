<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property int $id
 * @property string $judul
 * @property string|null $isi_content
 * @property int|null $id_jenis_file
 * @property string|null $filename
 * @property string|null $aktf
 */
class Content extends \yii\db\ActiveRecord
{
    public $filedok,$filedok2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filedok'],'file','skipOnEmpty'=>false],
            [['filedok2'],'file','skipOnEmpty'=>false],
             [['id', 'id_jenis_file'], 'integer'],
            [['isi_content', 'aktf'], 'string'],
            [['judul', 'filename','latar'], 'string', 'max' => 50],
     //       [['judul','isi_content', 'filename'], 'required'],
       //     [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => 'Judul',
            'isi_content' => 'Isi Content',
            'id_jenis_file' => 'Jenis yang ditampilkan',
            'filename' => 'Filename',
            'aktf' => 'Aktf',
        ];
    }
    
    public function upload(){
        if($this->validate()){
            $filename = date('YmdHis').'.'.$this->filedok->extension;
            $filename2 = date('HisYmd').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->latar = $filename2;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            $this->filedok2->saveAs(Yii::getAlias('@path_upload/').$filename2);
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
            $filename = date('YmdHis').'.'.$this->filedok->extension;
            $this->filename = $filename;
            $this->filedok->saveAs(Yii::getAlias('@path_upload/').$filename);
            return true;
        }else{
            return false;
        }
    }
}
