<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_kecamatan".
 *
 * @property int $id
 * @property int|null $id_ref_kelurahan
 * @property string|null $nm_kecamatan
 *
 * @property DataAgen[] $dataAgens
 * @property DataAgen[] $dataAgens0
 * @property RefKelurahan $refKelurahan
 * @property RegistrasiAgen[] $registrasiAgens
 */
class RefKecamatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_kecamatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_kelurahan'], 'integer'],
            [['nm_kecamatan'], 'string', 'max' => 50],
            [['id_ref_kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['id_ref_kelurahan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_kelurahan' => 'Id Ref Kelurahan',
            'nm_kecamatan' => 'Nm Kecamatan',
        ];
    }

    /**
     * Gets query for [[DataAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgens()
    {
        return $this->hasMany(DataAgen::className(), ['id_ref_kecamatan' => 'id']);
    }

    /**
     * Gets query for [[DataAgens0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgens0()
    {
        return $this->hasMany(DataAgen::className(), ['id_ref_kecamatan_domisili' => 'id']);
    }

    /**
     * Gets query for [[RefKelurahan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelurahan()
    {
        return $this->hasOne(RefKelurahan::className(), ['id' => 'id_ref_kelurahan']);
    }

    /**
     * Gets query for [[RegistrasiAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrasiAgens()
    {
        return $this->hasMany(RegistrasiAgen::className(), ['id_ref_kecamatan' => 'id']);
    }
    
    public static function getDropdownkecamatan(){
        $array = RefKecamatan::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nm_kecamatan');
    }
}
