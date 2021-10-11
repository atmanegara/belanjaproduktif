<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_rekening".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property int|null $id_ref_bank
 * @property string|null $no_rek
 *
 * @property RefBank $refBank
 */
class DataRekening extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_rekening';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_bank'], 'integer'],
            [['id_ref_bank', 'no_rek'], 'required', 'max' => 50],
            [['no_acak', 'no_rek'], 'string', 'max' => 50],
            [['id_ref_bank'], 'exist', 'skipOnError' => true, 'targetClass' => RefBank::className(), 'targetAttribute' => ['id_ref_bank' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_acak' => 'No Acak',
            'id_ref_bank' => 'Jenis Bank',
            'no_rek' => 'No Rek',
        ];
    }

    /**
     * Gets query for [[RefBank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefBank()
    {
        return $this->hasOne(RefBank::className(), ['id' => 'id_ref_bank']);
    }
}
