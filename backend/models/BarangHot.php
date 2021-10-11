<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "barang_hot".
 *
 * @property int $id
 * @property int|null $id_ref_barang
 * @property int|null $no_urut
 */
class BarangHot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_hot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_barang'],'string'],
            [['no_urut'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_barang' => 'Id Ref Barang',
        ];
    }
}
