<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ket_saldo".
 *
 * @property int $id
 * @property string|null $ket_saldo
 *
 * @property KonfirmasiTopup[] $konfirmasiTopups
 * @property TransaksiSaldo[] $transaksiSaldos
 */
class KetSaldo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ket_saldo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket_saldo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ket_saldo' => 'Ket Saldo',
        ];
    }

    /**
     * Gets query for [[KonfirmasiTopups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKonfirmasiTopups()
    {
        return $this->hasMany(KonfirmasiTopup::className(), ['id_ket_saldo' => 'id']);
    }

    /**
     * Gets query for [[TransaksiSaldos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiSaldos()
    {
        return $this->hasMany(TransaksiSaldo::className(), ['id_ket_saldo' => 'id']);
    }
    
    public static function dropDownlistAll(){
        $array = KetSaldo::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'ket_saldo');
    }
      public static function dropDownlist(){
        $array = KetSaldo::find()->where(['id'=>['1','2']])->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'ket_saldo');
    }
}
