<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_sub_header".
 *
 * @property int $id
 * @property int $id_menu_header
 * @property int|null $no_urut
 * @property string|null $label
 * @property string|null $url
 * @property string|null $icon
 * @property string|null $aktif
 *
 * @property MenuHeader $menuHeader
 * @property MenuSubHeaderTk2[] $menuSubHeaderTk2s
 */
class MenuSubHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_sub_header';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_menu_header', 'no_urut'], 'integer'],
            [['aktif'], 'string'],
            [['label', 'url', 'icon'], 'string', 'max' => 50],
            [['id_menu_header'], 'exist', 'skipOnError' => true, 'targetClass' => MenuHeader::className(), 'targetAttribute' => ['id_menu_header' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_menu_header' => 'Id Menu Header',
            'no_urut' => 'No Urut',
            'label' => 'Label',
            'url' => 'Url',
            'icon' => 'Icon',
            'aktif' => 'Aktif',
        ];
    }

    /**
     * Gets query for [[MenuHeader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenuHeader()
    {
        return $this->hasOne(MenuHeader::className(), ['id' => 'id_menu_header']);
    }

    /**
     * Gets query for [[MenuSubHeaderTk2s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenuSubHeaderTk2s()
    {
        return $this->hasMany(MenuSubHeaderTk2::className(), ['id_menu_sub_header' => 'id']);
    }
}
