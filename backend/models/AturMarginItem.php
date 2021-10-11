<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "atur_margin_item".
 *
 * @property int $id
 * @property int $id_ref_barang
 * @property float|null $nilai
 *
 * @property RefBarang $refBarang
 */
class AturMarginItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atur_margin_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_barang'], 'integer'],
            [['nilai','harga_satuan'], 'number'],
            [['id_ref_barang'], 'exist', 'skipOnError' => true, 'targetClass' => RefBarang::className(), 'targetAttribute' => ['id_ref_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_barang' => 'Barang',
            'nilai' => 'Nilai Margin (%)',
        ];
    }

    /**
     * Gets query for [[RefBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefBarang()
    {
        return $this->hasOne(RefBarang::className(), ['id' => 'id_ref_barang']);
    }
}
