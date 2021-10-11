<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property int $id_ref_agen
 * @property string|null $nama_role
 * @property string|null $aktif
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen'],'integer'],
            [['aktif'], 'string'],
            [['nama_role'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_role' => 'Nama Role',
            'aktif' => 'Aktif',
        ];
    }
    
    public static function dropdownRole(){
        $array = Role::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nama_role');
    }
        public static function dropdownRoleRef(){
        $array = Role::find()->asArray()->all();
        return ArrayHelper::map($array,'id_ref_agen','nama_role');
    }
}
