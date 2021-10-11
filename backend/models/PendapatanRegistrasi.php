<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pendapatan_registrasi".
 *
 * @property int $id
 * @property int|null $id_ref_agen
 * @property float|null $nominal
 * @property string|null $tgl_masuk
 *
 * @property RefAgen $refAgen
 */
class PendapatanRegistrasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendapatan_registrasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_acak'], 'string'],
            [['id_ref_agen'], 'integer'],
            [['nominal'], 'number'],
            [['tgl_masuk'], 'safe'],
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
            'tgl_masuk' => 'Tgl Masuk',
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
    
    //INSERT
    public static function sumAll(){
        $query = (new \yii\db\Query())
                ->select(['Sum(nominal) as nominal'])
                ->from('pendapatan_registrasi')->one();
        return $query['nominal'];
    }
}
