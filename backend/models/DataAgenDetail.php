<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_agen_detail".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property int|null $id_ref_bank
 * @property string|null $no_rek
 */
class DataAgenDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_agen_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_bank'], 'integer'],
            [['id_ref_bank', 'no_rek','aktif','atas_nama'], 'required', 'message' => 'Wajib di isi'],
            [['no_acak', 'no_rek','aktif','atas_nama'], 'string'],
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
            'id_ref_bank' => 'Nama Bank',
            'no_rek' => 'No Rekening',
            'atas_nama'=>'Nama Pemilik Rekening'
        ];
    }
}
