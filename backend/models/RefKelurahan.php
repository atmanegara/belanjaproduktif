<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_kelurahan".
 *
 * @property int $id
 * @property int|null $id_ref_kabupaten
 * @property int|null $nm_kelurahan
 *
 * @property DataAgen[] $dataAgens
 * @property RefKecamatan[] $refKecamatans
 * @property RefKabupaten $refKabupaten
 * @property RegistrasiAgen[] $registrasiAgens
 */
class RefKelurahan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_kelurahan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_kabupaten', 'nm_kelurahan'], 'integer'],
            [['id_ref_kabupaten'], 'exist', 'skipOnError' => true, 'targetClass' => RefKabupaten::className(), 'targetAttribute' => ['id_ref_kabupaten' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_kabupaten' => 'Id Ref Kabupaten',
            'nm_kelurahan' => 'Nm Kelurahan',
        ];
    }

    /**
     * Gets query for [[DataAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgens()
    {
        return $this->hasMany(DataAgen::className(), ['id_ref_kelurahan' => 'id']);
    }

    /**
     * Gets query for [[RefKecamatans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKecamatans()
    {
        return $this->hasMany(RefKecamatan::className(), ['id_ref_kelurahan' => 'id']);
    }

    /**
     * Gets query for [[RefKabupaten]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefKabupaten()
    {
        return $this->hasOne(RefKabupaten::className(), ['id' => 'id_ref_kabupaten']);
    }

    /**
     * Gets query for [[RegistrasiAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrasiAgens()
    {
        return $this->hasMany(RegistrasiAgen::className(), ['id_ref_kelurahan' => 'id']);
    }
    
    public static function getDropdownkelurahan(){
        $array = RefKelurahan::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nm_kelurahan');
    }
}
