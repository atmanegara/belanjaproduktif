<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_agen_waris".
 *
 * @property int $id
 * @property int|null $id_data_agen
 * @property string|null $nama_waris
 * @property string|null $nope_waris
 * @property string|null $jns_bank
 * @property string|null $atas_nama_bank
 * @property string|null $norek_bank
 *
 * @property DataAgen $dataAgen
 */
class DataAgenWaris extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_agen_waris';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_data_agen'], 'integer'],
            [['nama_waris', 'nope_waris', 'jns_bank', 'atas_nama_bank', 'norek_bank'], 'required', 'message' =>'Wajib di isi'],
            [['nama_waris', 'nope_waris', 'jns_bank', 'atas_nama_bank', 'norek_bank'], 'string', 'max' => 50],
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
            'id_data_agen' => 'Agen',
            'nama_waris' => 'Nama',
            'nope_waris' => 'Telp',
            'jns_bank' => 'Bank',
            'atas_nama_bank' => 'Atas Nama',
            'norek_bank' => 'Rekening',
        ];
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
}
