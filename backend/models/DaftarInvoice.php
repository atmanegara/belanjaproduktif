<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "daftar_invoice".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property string|null $bayar Y:sudah bayar, N:belum bayar
 */
class DaftarInvoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daftar_invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bayar'], 'string'],
            [['no_acak', 'no_invoice'], 'string', 'max' => 50],
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
            'no_invoice' => 'No Invoice',
            'bayar' => 'Bayar',
        ];
    }
}
