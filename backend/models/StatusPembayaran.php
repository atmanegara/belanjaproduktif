<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status_pembayaran".
 *
 * @property int $id
 * @property string|null $status_pembayaran
 *
 * @property KonfirmasiPembayaran[] $konfirmasiPembayarans
 */
class StatusPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_pembayaran'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status_pembayaran' => 'Status Pembayaran',
        ];
    }

    /**
     * Gets query for [[KonfirmasiPembayarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKonfirmasiPembayarans()
    {
        return $this->hasMany(KonfirmasiPembayaran::className(), ['id_status_pembayaran' => 'id']);
    }
    
    public static function Dropdownlist(){
        $array = StatusPembayaran::find()->asArray()->all();
        return ArrayHelper::map($array,'id','status_pembayaran');
    }
}
