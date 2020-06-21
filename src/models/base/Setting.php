<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace eluhr\shop\models\base;

use Yii;

/**
 * This is the base-model class for table "sp_settings".
 *
 * @property string $key
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property string $aliasModel
 */
abstract class Setting extends \eluhr\shop\models\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sp_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['key', 'value'], 'string', 'max' => 255],
            [['key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('shop', 'Key'),
            'value' => Yii::t('shop', 'Value'),
            'created_at' => Yii::t('shop', 'Created At'),
            'updated_at' => Yii::t('shop', 'Updated At'),
        ];
    }


    
    /**
     * @inheritdoc
     * @return \eluhr\shop\models\query\SettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eluhr\shop\models\query\SettingQuery(get_called_class());
    }
}
