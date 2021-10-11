<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_item_barang_agen".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property int|null $id_ref_barang
 * @property string|null $tgl_masuk
 */
class DataItemBarangAgen extends \yii\db\ActiveRecord
{
 
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_item_barang_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_barang'], 'required','message'=>'Wajib di isi'],
            [['id_ref_barang','id_data_toko','id_data_barang'], 'integer'],
            [['tgl_masuk'], 'safe'],
            [['no_acak'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'id_ref_barang' => 'Item Barang',
            'tgl_masuk' => 'Tgl Masuk',
        ];
    }
        public function getRefBarang()
    {
        return $this->hasOne(RefBarang::className(), ['id' => 'id_ref_barang']);
    }
    
    public static function countItemByAgen($no_acak){
        $count = DataItemBarangAgen::find()->where(['no_acak'=>$no_acak])->count();
        return $count;
    }
}
