<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_program_agen".
 *
 * @property int $id
 * @property int|null $id_program_agen
 * @property string|null $tgl_awal
 * @property string|null $tgl_akhir
 * @property string|null $ket
 * @property string|null $aktif
 * @property int|null $tahunke
 *
 * @property ProgramAgen $programAgen
 */
class DetailProgramAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_program_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_program_agen', 'tahunke'], 'integer'],
            [['tgl_awal', 'tgl_akhir'], 'safe'],
            [['aktif'], 'string'],
            [['ket'], 'string', 'max' => 50],
            [['id_program_agen'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramAgen::className(), 'targetAttribute' => ['id_program_agen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_program_agen' => 'Id Program Agen',
            'tgl_awal' => 'Tgl Awal',
            'tgl_akhir' => 'Tgl Akhir',
            'ket' => 'Ket',
            'aktif' => 'Berangkat',
            'tahunke' => 'Tahunke',
        ];
    }

    /**
     * Gets query for [[ProgramAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramAgen()
    {
        return $this->hasOne(ProgramAgen::className(), ['id' => 'id_program_agen']);
    }
}
