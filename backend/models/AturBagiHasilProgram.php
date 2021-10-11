<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "atur_bagi_hasil_program".
 *
 * @property int $id
 * @property int|null $id_ref_agen dari agen
 * @property int|null $id_ref_program_agen
 * @property float|null $nominal
 *
 * @property RefAgen $refAgen
 * @property RefProgramAgen $refProgramAgen
 */
class AturBagiHasilProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atur_bagi_hasil_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen', 'id_ref_program_agen'], 'integer'],
            [['nominal'], 'number'],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
            [['id_ref_program_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefProgramAgen::className(), 'targetAttribute' => ['id_ref_program_agen' => 'id']],
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
            'id_ref_program_agen' => 'Id Ref Program Agen',
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

    /**
     * Gets query for [[RefProgramAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramAgen()
    {
        return $this->hasOne(RefProgramAgen::className(), ['id' => 'id_ref_program_agen']);
    }
}
