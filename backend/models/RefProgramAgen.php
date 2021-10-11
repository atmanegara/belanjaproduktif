<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_program_agen".
 *
 * @property int $id
 * @property string|null $nama_program
 *
 * @property DetailProgramAgen[] $detailProgramAgens
 * @property ProgramAgen[] $programAgens
 */
class RefProgramAgen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_program_agen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_program'], 'required', 'message' =>"Wajib di isi"],
               [['biaya'], 'integer'],
               [['nama_program'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_program' => 'Nama Program',
        ];
    }

    /**
     * Gets query for [[DetailProgramAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailProgramAgens()
    {
        return $this->hasMany(DetailProgramAgen::className(), ['id_ref_program_agen' => 'id']);
    }

    /**
     * Gets query for [[ProgramAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramAgens()
    {
        return $this->hasMany(ProgramAgen::className(), ['id_ref_program_agen' => 'id']);
    }
    
    public static function dropdownlist()
    {
        $array = RefProgramAgen::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_program');
    }
}
