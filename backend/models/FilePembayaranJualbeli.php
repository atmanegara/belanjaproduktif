<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "file_pembayaran_jualbeli".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property int|null $id_pembayaran_jualbeli
 * @property string|null $no_invoice
 * @property string|null $filename
 */
class FilePembayaranJualbeli extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_pembayaran_jualbeli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pembayaran_jualbeli'], 'integer'],
            [['no_acak', 'no_invoice'], 'string', 'max' => 50],
            [['filename'], 'string', 'max' => 160],
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
            'id_pembayaran_jualbeli' => 'Id Pembayaran Jualbeli',
            'no_invoice' => 'No Invoice',
            'filename' => 'Filename',
        ];
    }
}
