<?php

namespace eluhr\shop\models;

use eluhr\shop\components\behaviors\FiltersBehavior;
use eluhr\shop\components\traits\FiltersTrait;
use Yii;
use \eluhr\shop\models\base\Filter as BaseFilter;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sp_filter".
 */
class Filter extends BaseFilter
{
    use FiltersTrait  {
        rules as traitRules;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['filters'] = [
            'class' => FiltersBehavior::class,
            'junctionModel' => TagXFilter::class,
            'typeColumnName' => 'facet_id',
            'filterColumnName' => 'tag_id'
        ];
        return $behaviors;
    }

    public function rules()
    {
        $rules = $this->traitRules();
        $rules[] = [['presentation', 'rank'],'required'];
        return $rules;
    }


    public static function presentations()
    {
        return [
            self::PRESENTATION_DROPDOWN => Yii::t('shop', 'Dropdown'),
            self::PRESENTATION_RADIOS => Yii::t('shop', 'Radios'),
        ];
    }

    public function tagData()
    {
        return ArrayHelper::map($this->getTagXFilters()->orderBy(['rank' => SORT_ASC])->all(), 'tag.id', 'tag.name');
    }

    public function tagFacets($productIds = null)
    {
        $tagData =  $this->tagData();
        $tagProductIds = TagXProduct::find()->select('tag_id')->andWhere(['tag_id' => array_keys($tagData)])->distinct()->asArray()->column();
        $facets = [];
        foreach ($tagData as $tagid => $tagName) {
            if (in_array($tagid, $tagProductIds)) {
                $facets[$tagid] = $tagName;
            }
        }
        // Yii::debug($facets);
        // Yii::debug($tagProductIds);
        return $facets;
    }

}
