<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_sumber_komisi".
 *
 * @property int $id
 * @property string|null $ket_sumber
 *
 * @property TransaksiKomisi[] $transaksiKomisis
 */
class RefSumberKomisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_sumber_komisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ket_sumber'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ket_sumber' => 'Ket Sumber',
        ];
    }

    /**
     * Gets query for [[TransaksiKomisis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksiKomisis()
    {
        return $this->hasMany(TransaksiKomisi::className(), ['ket' => 'id']);
    }
}
