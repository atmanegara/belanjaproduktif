<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_barang".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $nama_barang
 * @property string|null $filename
 */
class RefBarang extends \yii\db\ActiveRecord {

    public $filedok;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'ref_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                 [['kode_barcode','kode', 'nama_barang'], 'required', 'message' => 'Wajib di isi'],
       [['filedok'], 'file', 'skipOnEmpty' => false,'on'=>'update-gambar'],
            [['kode', 'filename'], 'string', 'max' => 50],
            [['nama_barang'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama_barang' => 'Nama Barang',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $filename = date('YmdHis');
            $this->filename = $filename . '.' . $this->filedok->extension;

            $this->filedok->saveAs(Yii::getAlias('@path_upload') . '/' . $this->filename);
            return true;
        } else {
            return false;
        }
    }

    public function reupload() {
        if ($this->validate()) {
if(!empty($this->filename)){
            $pathfilename = Yii::getAlias('@path_upload/') . $this->filename;
            if (file_exists($pathfilename)) {
                unlink($pathfilename);
            }
        }
            $filename = date('YmdHis');
            $this->filename = $filename . '.' . $this->filedok->extension;

      $this->filedok->saveAs(Yii::getAlias('@path_upload') . '/' . $this->filename);
            return true;
        } else {
            return false;
        }
    }
    
    


public static function dropdownlist(){
        $item = RefBarang::find()->asArray()->all();
        
        return \yii\helpers\ArrayHelper::map($item, 'id', 'nama_barang');
    }

}
