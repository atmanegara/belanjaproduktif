<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_header".
 *
 * @property int $id
 * @property int $no_urut
 * @property string|null $label
 * @property string|null $url
 * @property string|null $icon
 * @property string|null $aktif
 *
 * @property MenuSubHeader[] $menuSubHeaders
 */
class MenuHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_header';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_urut'], 'integer'],
            [['aktif'], 'string'],
            [['label', 'url', 'icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_urut' => 'No Urut',
            'label' => 'Label',
            'url' => 'Url',
            'icon' => 'Icon',
            'aktif' => 'Aktif',
        ];
    }

    /**
     * Gets query for [[MenuSubHeaders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenuSubHeaders()
    {
        return $this->hasMany(MenuSubHeader::className(), ['id_menu_header' => 'id']);
    }
}
