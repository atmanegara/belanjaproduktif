<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "franchice".
 *
 * @property int $id
 * @property int|null $id_ref_agen
 * @property int|null $nominal
 * @property int|null $diskon
 * @property int|null $total
 *
 * @property RefAgen $refAgen
 */
class Franchice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'franchice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen', 'nominal', 'diskon', 'total'], 'integer'],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_agen' => 'Agen',
            'nominal' => 'Nominal',
            'diskon' => 'Diskon',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[RefAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgen()
    {
        return $this->hasOne(RefAgen::className(), ['id' => 'id_ref_agen']);
    }
}
