<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "riwayat_bagi_komisi".
 *
 * @property int $id
 * @property int|null $id_user tukang bagi
 * @property int|null $id_data_agen penerima
 * @property string|null $tgl_dibagi
 * @property int|null $id_ref_sumber_komisi
 * @property float|null $nominal
 * @property string|null $keterangan
 * @property string|null $tgljam_input
 *
 * @property DataAgen $dataAgen
 * @property RefSumberKomisi $refSumberKomisi
 */
class RiwayatBagiKomisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'riwayat_bagi_komisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_data_agen', 'id_ref_sumber_komisi'], 'integer'],
            [['tgl_dibagi', 'tgljam_input'], 'safe'],
            [['nominal'], 'number'],
            [['keterangan'], 'string', 'max' => 160],
            [['id_data_agen'], 'exist', 'skipOnError' => true, 'targetClass' => DataAgen::className(), 'targetAttribute' => ['id_data_agen' => 'id']],
            [['id_ref_sumber_komisi'], 'exist', 'skipOnError' => true, 'targetClass' => RefSumberKomisi::className(), 'targetAttribute' => ['id_ref_sumber_komisi' => 'id']],
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
            'id_data_agen' => 'Data Agen',
            'tgl_dibagi' => 'Tgl Input Komisi',
            'id_ref_sumber_komisi' => 'Keterangan',
            'nominal' => 'Nominal',
            'keterangan' => 'Catatan',
            'tgljam_input' => 'Tgljam Input',
        ];
    }

    /**
     * Gets query for [[DataAgen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataAgen()
    {
        return $this->hasOne(DataAgen::className(), ['id' => 'id_data_agen']);
    }

    /**
     * Gets query for [[RefSumberKomisi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefSumberKomisi()
    {
        return $this->hasOne(RefSumberKomisi::className(), ['id' => 'id_ref_sumber_komisi']);
    }
}
