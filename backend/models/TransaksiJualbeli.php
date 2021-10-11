<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaksi_jualbeli".
 *
 * @property int $id
 * @property string|null $no_invoice
 * @property string|null $tgl_invoice
 * @property string|null $no_acak
 * @property float|null $total_bayar
 * @property float|null $total_tunai
 * @property float|null $total_kembali
 */
class TransaksiJualbeli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi_jualbeli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_invoice'], 'safe'],
            [['total_bayar', 'total_tunai', 'total_kembali'], 'number'],
            [['no_invoice', 'no_acak'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_invoice' => 'No Invoice',
            'tgl_invoice' => 'Tgl Invoice',
            'no_acak' => 'No Acak',
            'total_bayar' => 'Total Bayar',
            'total_tunai' => 'Total Tunai',
            'total_kembali' => 'Total Kembali',
        ];
    }
}
