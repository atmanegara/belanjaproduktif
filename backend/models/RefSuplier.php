<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ref_suplier".
 *
 * @property int $id
 * @property string|null $nama_suplier
 * @property string|null $alamat
 * @property string|null $no_telp
 *
 * @property CatatanBarang[] $catatanBarangs
 */
class RefSuplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_suplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_suplier', 'no_telp'], 'string', 'max' => 50],
            [['alamat'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_suplier' => 'Nama Suplier',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
        ];
    }

    /**
     * Gets query for [[CatatanBarangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanBarangs()
    {
        return $this->hasMany(CatatanBarang::className(), ['id_ref_suplier' => 'id']);
    }
    
    public static function getDropdownlist()
    {
        $array = RefSuplier::find()->asArray()->all();
        return \yii\helpers\ArrayHelper::map($array, 'id', 'nama_suplier');
    }
}
