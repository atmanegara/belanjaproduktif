<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "histori_addcart".
 *
 * @property int $id
 * @property int|null $no_acak
 * @property string|null $tgl_addcart
 * @property int|null $id_tahap
 * @property string|null $status
 */
class HistoriAddcart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'histori_addcart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'no_acak', 'id_tahap'], 'integer'],
            [['tgl_addcart'], 'safe'],
            [['status'], 'string'],
            [['id'], 'unique'],
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
            'tgl_addcart' => 'Tgl Addcart',
            'id_tahap' => 'Id Tahap',
            'status' => 'Status',
        ];
    }
}
