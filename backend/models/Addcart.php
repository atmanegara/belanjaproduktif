<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "addcart".
 *
 * @property int $id
 * @property int|null $no_acak
 * @property int|null $id_data_barang
 * @property int|null $id_data_agen
 * @property int|null $qty
 * @property string|null $tgl_masuk
 */
class Addcart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addcart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_acak', 'id_data_barang', 'id_data_agen', 'qty'], 'integer'],
            [['tgl_masuk'], 'safe'],
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
            'id_data_barang' => 'Id Data Barang',
            'id_data_agen' => 'Id Data Agen',
            'qty' => 'Qty',
            'tgl_masuk' => 'Tgl Masuk',
        ];
    }
    
    public static function getTotalByNoacak($no_acak){
        $data = Addcart::find()->where(['no_acak'=>$no_acak,'pilih'=>'N'])->groupBy('no_acak,id_data_barang')->count();
        return $data;
    }
}
