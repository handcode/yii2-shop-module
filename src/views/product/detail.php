<?php

use eluhr\shop\helpers\RbacHelper;
use eluhr\shop\widgets\PriceDisplay;
use hrzg\widget\widgets\Cell;
use eluhr\shop\models\Product;
use eluhr\shop\models\ShoppingCartModify;
use eluhr\shop\models\Variant;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var Product $product
 * @var Variant $variant
 * @var View $this
 * @var ShoppingCartModify $shoppingCartModel
 */

$this->registerMetaTag(['property' => 'og:image', 'content' => $variant->thumbnailImage()]);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:description', 'content' => strip_tags($variant->description)]);

$this->registerCss(".thumbnail-image { background-image: url('{$variant->thumbnailImage()}');}");

echo Html::a(Yii::t('shop', 'Back'), ['/' . $this->context->module->id . '/default/index'], ['class' => 'btn btn-back btn-link']);
?>
<?= Cell::widget(['id' => 'product-top-global']) ?>
<?= Cell::widget(['id' => 'product-top-' . $product->id]) ?>
    <div class="item-detail-view <?=$variant->getHasDiscount() ? 'has-discount' : ''?>">
        <div class="item-top">
            <h1 class="product-title"><?= $product->title ?></h1>
            <h2 class="variant-title"><?= $variant->title ?></h2>
            <?php if (RbacHelper::userIsShopEditor() && !$product->is_inventory_independent): ?>
                <p class="variant-stock"><?= Yii::t('shop', 'Stock: {stock}', ['stock' => $variant->stock]) ?></p>
            <?php endif; ?>
            <?php

            if ($variant->stock > 0 || $product->is_inventory_independent) {
                $form = ActiveForm::begin([
                    'id' => 'add-to-shopping-cart',
                    'action' => ['/shop/shopping-cart/update-item']
                ]);

                echo $form->field($shoppingCartModel, 'variantId')->hiddenInput(['value' => $variant->id])->label(false)->hint(false);
                echo $form->field($shoppingCartModel, 'quantity')->input('number', ['max' => $variant->stock, 'min' => 0]);

                $extraInfos = $variant->getExtraInfoList();
                if (!empty($extraInfos)) {
                    echo $form->field($shoppingCartModel, 'extraInfo')->widget(Select2::class, [
                        'data' => $extraInfos,
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'hideSearch' => true
                    ]);
                }

                echo Html::submitButton(Yii::t('shop', 'Add to shopping cart'), ['class' => 'btn btn-primary']);

                ActiveForm::end();
            } else {
                if (!$product->is_inventory_independent) {
                    echo Html::tag('p', Yii::t('shop','Currently out of stock'),['class' => 'out-of-stock-info']);
                }
            }
            ?>
        </div>
        <div class="item-content">
            <div class="variant-content-left">
                <div class="price"><?=PriceDisplay::widget(['variant' => $variant])?></div>
            </div>
            <div class="variant-content-right">
                <div class="thumbnail-image"></div>
                <?php
                foreach ($product->activeVariants as $activeVariant) {
                    if ($activeVariant->id !== $variant->id) {
                        $this->registerCss("#variant-{$activeVariant->id} { background-image: url('{$activeVariant->thumbnailImage()}');}");
                        echo Html::a(Html::tag('div', '', ['id' => 'variant-' . $activeVariant->id,'class' => 'variant-preview-thumbnail']) . Html::tag('span', $activeVariant->title, ['class' => 'variant-preview-title']), $activeVariant->detailUrl(), ['class' => 'variant-link']);
                    }
                }
                ?>
            </div>
            <div class="variant-description">
                <div class="variant-delivery-time-text"><?php echo $variant->deliveryTimeText() ?></div>
                <?= $variant->description ?>
            </div>
        </div>
    </div>
<?= Cell::widget(['id' => 'product-bottom-' . $product->id]) ?>
<?= Cell::widget(['id' => 'product-bottom-global']) ?>
