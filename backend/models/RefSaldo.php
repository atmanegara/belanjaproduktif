<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_saldo".
 *
 * @property int $id
 * @property int|null $id_ref_agen
 * @property float|null $nominal
 *
 * @property RefAgen $refAgen
 */
class RefSaldo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_saldo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen'], 'integer'],
            [['nominal'], 'number'],
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
            'id_ref_agen' => 'Id Ref Agen',
            'nominal' => 'Nominal',
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
