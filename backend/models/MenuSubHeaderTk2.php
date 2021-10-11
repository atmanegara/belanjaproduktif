<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_sub_header_tk2".
 *
 * @property int $id
 * @property int $id_menu_sub_header
 * @property int $no_urut
 * @property string|null $label
 * @property string|null $url
 * @property string|null $icon
 * @property string|null $aktif
 *
 * @property MenuSubHeader $menuSubHeader
 */
class MenuSubHeaderTk2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_sub_header_tk2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_menu_sub_header', 'no_urut'], 'integer'],
            [['aktif'], 'string'],
            [['label', 'url', 'icon'], 'string', 'max' => 50],
            [['id_menu_sub_header'], 'exist', 'skipOnError' => true, 'targetClass' => MenuSubHeader::className(), 'targetAttribute' => ['id_menu_sub_header' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_menu_sub_header' => 'Id Menu Sub Header',
            'no_urut' => 'No Urut',
            'label' => 'Label',
            'url' => 'Url',
            'icon' => 'Icon',
            'aktif' => 'Aktif',
        ];
    }

    /**
     * Gets query for [[MenuSubHeader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenuSubHeader()
    {
        return $this->hasOne(MenuSubHeader::className(), ['id' => 'id_menu_sub_header']);
    }
}
