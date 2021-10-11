<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "program_agen".
 *
 * @property int $id
 * @property int|null $id_data_agen
 * @property string|null $no_acak
 * @property int|null $id_ref_program_agen
 * @property int|null $tahun
 *
 * @property RefProgramAgen $refProgramAgen
 * @property DataAgen $dataAgen
 */
class ProgramAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_agen', 'id_ref_program_agen', 'tahun'], 'integer'],
            [['id_data_agen', 'id_ref_program_agen'], 'required','message'=>'Wajib di isi'],
            [['no_acak','id_data_agen'], 'unique', 'message' => 'Data sudah ada, cek kembali'],
                   [['no_acak'], 'string', 'max' => 50],
            [['id_ref_program_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefProgramAgen::className(), 'targetAttribute' => ['id_ref_program_agen' => 'id']],
            [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_data_agen' => 'Id Data Agen',
            'no_acak' => 'No Acak',
            'id_ref_program_agen' => 'Program',
            'tahun' => 'Tahun',
        ];
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

    /**
     * Gets query for [[DataAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgen()
    {
        return $this->hasOne(DataAgen::className(), ['id' => 'id_data_agen']);
    }
    
    public static function bykProgramAgen(){
        $model = ProgramAgen::find()->groupBy('id_ref_program_agen')->count();
        return $model;
    }
}
