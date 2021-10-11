<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alamat_konsumen".
 *
 * @property int $id
 * @property string $no_acak
 * @property string|null $alamat
 * @property int|null $id_data_konsumen
 * @property string|null $ini
 *
 * @property DataKonsumen $dataKonsumen
 */
class AlamatKonsumen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alamat_konsumen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat', 'ini'], 'string'],
            [['id_data_konsumen'], 'integer'],
            [['no_acak'], 'string', 'max' => 50],
            [['id_data_konsumen'], 'exist', 'skipOnError' => true, 'targetClass' => DataKonsumen::className(), 'targetAttribute' => ['id_data_konsumen' => 'id']],
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
            'alamat' => 'Alamat',
            'id_data_konsumen' => 'Id Data Konsumen',
            'ini' => 'Ini',
        ];
    }

    /**
     * Gets query for [[DataKonsumen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataKonsumen()
    {
        return $this->hasOne(DataKonsumen::className(), ['id' => 'id_data_konsumen']);
    }
}
