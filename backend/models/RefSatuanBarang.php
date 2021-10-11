<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_satuan_barang".
 *
 * @property int $id
 * @property string|null $nama_satuan
 *
 * @property DataBarang[] $dataBarangs
 */
class RefSatuanBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_satuan_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_satuan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_satuan' => 'Nama Satuan',
        ];
    }

    /**
     * Gets query for [[DataBarangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataBarangs()
    {
        return $this->hasMany(DataBarang::className(), ['id_ref_satuan_barang' => 'id']);
    }
    
    public static function getdropdownlist(){
        $array= RefSatuanBarang::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nama_satuan');
    }
}
