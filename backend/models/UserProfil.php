<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_profil".
 *
 * @property int $id
 * @property int|null $id_user
 * @property string|null $nama_lengkap
 * @property string|null $alamat
 * @property string|null $no_telp
 * @property string|null $email
 * @property string|null $no_identitas
 * @property string|null $foto_user
 */
class UserProfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'integer'],
            [['alamat'], 'string'],
            [['nama_lengkap', 'no_telp', 'email', 'no_identitas', 'foto_user'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'nama_lengkap' => 'Nama Lengkap',
            'alamat' => 'Alamat',
            'no_telp' => 'No Telp',
            'email' => 'Email',
            'no_identitas' => 'No Identitas',
            'foto_user' => 'Foto User',
        ];
    }
}
