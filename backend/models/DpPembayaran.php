<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dp_pembayaran".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_invoice
 * @property int|null $id_franchice
 * @property int|null $id_status_dp
 * @property int|null $tahap_dp
 * @property float|null $nominal
 * @property float|null $uang_muka
 * @property float|null $sisa
 */
class DpPembayaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dp_pembayaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_franchice', 'id_status_dp', 'tahap_dp'], 'integer'],
            [['nominal', 'uang_muka', 'sisa'], 'number'],
            [['no_acak','no_invoice'], 'string', 'max' => 50],
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
            'id_franchice' => 'Id Franchice',
            'id_status_dp' => 'Id Status Dp',
            'tahap_dp' => 'Tahap Dp',
            'nominal' => 'Nominal',
            'uang_muka' => 'Uang Muka',
            'sisa' => 'Sisa',
        ];
    }
}
