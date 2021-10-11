<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tentang_kami".
 *
 * @property int $id
 * @property string|null $nama_cv
 * @property string|null $no_siup
 * @property string|null $telp_cv
 * @property int|null $alamat_cv
 * @property string|null $kontak_lainnya
 */
class TentangKami extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tentang_kami';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'alamat_cv'], 'integer'],
            [['nama_cv', 'no_siup', 'telp_cv', 'kontak_lainnya','telp_admin','telp_marketting','email'], 'string', 'max' => 50],
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
            'nama_cv' => 'Nama Perusahaan / Badang Usaha',
            'no_siup' => 'No SIUP',
            'telp_cv' => 'Telp. Kantor',
            'alamat_cv' => 'Alamat',
            'telp_admin'=>'Telp (WA) Admin',
            'telp_marketing'=>'Telp (WA) Marketing',
            'email'=>'Email',
            'kontak_lainnya' => 'Info Lainnya',
        ];
    }
}
