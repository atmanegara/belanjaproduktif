<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_kurir".
 *
 * @property int $id
 * @property string|null $nama_kurir
 *
 * @property DetailPembayaran[] $detailPembayarans
 */
class RefKurir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_kurir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kurir'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_kurir' => 'Nama Kurir',
        ];
    }

    /**
     * Gets query for [[DetailPembayarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembayarans()
    {
        return $this->hasMany(DetailPembayaran::className(), ['id_ref_kurir' => 'id']);
    }
    
        public static function getDropdownlist(){
        $array = RefKurir::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array,'id','nama_kurir');
    }


    public static function getDropdownlistByHari($harini){
        $array =(new yii\db\Query()) //RefKurir::find()->asArray()->all();
                  ->select('a.id,a.nama_kurir')
                ->from('ref_kurir a')
                ->innerJoin('tarif_kurir b','a.id=b.id_ref_kurir')
                ->where(['b.hari'=>$harini])->all();
        
        return \yii\helpers\ArrayHelper::map($array,'id','nama_kurir');
    }
    }