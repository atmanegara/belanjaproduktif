<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_jenis_dok".
 *
 * @property int $id
 * @property int|null $id_ref_agen
 * @property string|null $nama_dok
 *
 * @property BerkasAgen[] $berkasAgens
 * @property RefAgen $refAgen
 */
class RefJenisDok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_jenis_dok';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ref_agen','nama_dok'],'required','message'=>'Wajib di isi'],
            [['id_ref_agen'], 'integer'],
            [['nama_dok'], 'string', 'max' => 50],
            [['id_ref_agen'], 'exist', 'skipOnError' => true, 'targetClass' => RefAgen::className(), 'targetAttribute' => ['id_ref_agen' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_agen' => 'Id Ref Agen',
            'nama_dok' => 'Nama Dok',
        ];
    }

    /**
     * Gets query for [[BerkasAgens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBerkasAgens()
    {
        return $this->hasMany(BerkasAgen::className(), ['id_ref_jenis_dok' => 'id']);
    }

    /**
     * Gets query for [[RefAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgen()
    {
        return $this->hasOne(RefAgen::className(), ['id' => 'id_ref_agen']);
    }
    
    public static function DropDownList()
    {
        $array = RefJenisDok::find()->asArray()->all();
        return ArrayHelper::map($array,'id','nama_dok');
    }
}
