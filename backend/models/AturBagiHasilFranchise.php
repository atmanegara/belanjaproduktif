<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "atur_bagi_hasil_franchise".
 *
 * @property int $id
 * @property int|null $id_ref_agen dari agen
 * @property float|null $nilai
 *
 * @property RefAgen $refAgen
 */
class AturBagiHasilFranchise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atur_bagi_hasil_franchise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen','nilai'], 'required','message'=>'Wajib di isi'],
            [['id_ref_agen'], 'unique','message'=>'data ini sudah ada'],
            [['id_ref_agen'], 'integer'],
            [['nilai'], 'number'],
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
            'nilai' => 'Nilai',
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
