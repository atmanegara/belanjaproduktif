<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "metode_transfer".
 *
 * @property int $id
 * @property string|null $nm_metode_transfer
 *
 * @property KonfirmasiPembayaran[] $konfirmasiPembayarans
 */
class MetodeTransfer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'metode_transfer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_metode_transfer'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm_metode_transfer' => 'Nm Metode Transfer',
        ];
    }

    /**
     * Gets query for [[KonfirmasiPembayarans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKonfirmasiPembayarans()
    {
        return $this->hasMany(KonfirmasiPembayaran::className(), ['id_metode_transfer' => 'id']);
    }
    
    public static function dropdownlist()
    {
        $array = MetodeTransfer::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nm_metode_transfer');
    }
}
