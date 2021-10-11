<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "data_bagi_hasil".
 *
 * @property int $id
 * @property string|null $no_acak
 * @property string|null $no_acak_tutup_buku
 * @property string|null $tgl_masuk
 * @property int|null $id_ref_agen
 * @property int|null $persen
 * @property int|null $hasil
 */
class DataBagiHasil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_bagi_hasil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_ref_agen', 'persen', 'hasil','jumlah'], 'number'],
            [['no_acak','no_acak_user', 'no_acak_tutup_buku', 'tgl_masuk'], 'string', 'max' => 50],
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
            'no_acak_tutup_buku' => 'No Acak Tutup Buku',
            'tgl_masuk' => 'Tgl Masuk',
            'id_ref_agen' => 'Id Ref Agen',
            'persen' => 'Persen',
            'hasil' => 'Hasil',
        ];
    }
}
