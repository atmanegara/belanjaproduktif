<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $no_acak
 * @property string $id_agen id_referensi agen
 * @property int $role_id
 * @property int $id_ref_agen
 * @property string $username
 * @property string $auth_key
 * @property string $password_string
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class User extends \yii\db\ActiveRecord
{
    public $nama_lengkap;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'id_ref_agen', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_string', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['no_acak', 'id_agen'], 'string', 'max' => 50],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token','nama_lengkap'], 'string', 'max' => 255],
            [['auth_key', 'password_string'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
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
            'id_agen' => 'Id Agen',
            'role_id' => 'Role ID',
            'id_ref_agen' => 'Id Ref Agen',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_string' => 'Password String',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }
}
