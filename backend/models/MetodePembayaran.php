<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "metode_pembayaran".
 *
 * @property int $id
 * @property string|null $ket
 *
 * @property DetailPembayaran[] $detailPembayarans
 */
class MetodePembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metode_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ket' => 'Ket',
        ];
    }

    /**
     * Gets query for [[DetailPembayarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPembayarans()
    {
        return $this->hasMany(DetailPembayaran::className(), ['id_metode_pembayaran' => 'id']);
    }
    
    public static function getDropdownlist(){
        $array = MetodePembayaran::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array,'id','ket');
    }
}
