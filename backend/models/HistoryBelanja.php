<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "history_belanja".
 *
 * @property int $id
 * @property string|null $no_invoice
 * @property int|null $status_belanja
 * @property string|null $tgljam
 */
class HistoryBelanja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_belanja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_belanja'], 'integer'],
            [['tgljam'], 'safe'],
            [['no_invoice'], 'string', 'max' => 50],
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
            'status_belanja' => 'Status Belanja',
            'tgljam' => 'Tgljam',
        ];
    }
}
