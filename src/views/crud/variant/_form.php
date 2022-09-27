<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var eluhr\shop\models\Variant $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="variant-form">

    <?php $form = ActiveForm::begin([
    'id' => 'Variant',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-danger',
    'fieldConfig' => [
             'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
             'horizontalCssClasses' => [
                 'label' => 'col-sm-2',
                 #'offset' => 'col-sm-offset-4',
                 'wrapper' => 'col-sm-8',
                 'error' => '',
                 'hint' => '',
             ],
         ],
    ]
    );
    ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            

<!-- attribute product_id -->
			<?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
$form->field($model, 'product_id')->dropDownList(
    \yii\helpers\ArrayHelper::map(eluhr\shop\models\Product::find()->all(), 'id', 'title'),
    [
        'prompt' => Yii::t('shop', 'Select'),
        'disabled' => (isset($relAttributes) && isset($relAttributes['product_id'])),
    ]
); ?>

<!-- attribute title -->
			<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<!-- attribute thumbnail_image -->
			<?= $form->field($model, 'thumbnail_image')->widget(hrzg\filemanager\widgets\FileManagerInputWidget::class,['handlerUrl' => '/filefly/api']); ?>

<!-- attribute rank -->
			<?= $form->field($model, 'rank')->textInput() ?>

<!-- attribute price -->
			<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

<!-- attribute hex_color -->
			<?= $form->field($model, 'hex_color')->textInput(['maxlength' => true]) ?>

<!-- attribute is_online -->
			<?= $form->field($model,'is_online')->checkbox([], false); ?>

<!-- attribute include_vat -->
			<?= $form->field($model, 'include_vat')->textInput() ?>

<!-- attribute stock -->
			<?= $form->field($model, 'stock')->textInput() ?>

<!-- attribute show_affiliate_link -->
			<?= $form->field($model, 'show_affiliate_link')->textInput() ?>

<!-- attribute min_days_shipping_duration -->
			<?= $form->field($model, 'min_days_shipping_duration')->textInput() ?>

<!-- attribute max_days_shipping_duration -->
			<?= $form->field($model, 'max_days_shipping_duration')->textInput() ?>

<!-- attribute discount_price -->
			<?= $form->field($model, 'discount_price')->textInput(['maxlength' => true]) ?>

<!-- attribute vat -->
			<?= $form->field($model, 'vat')->textInput(['maxlength' => true]) ?>

<!-- attribute description -->
			<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<!-- attribute configurator_data -->
			<?= $form->field($model, 'configurator_data')->textarea(['rows' => 6]) ?>

<!-- attribute created_at -->

<!-- attribute updated_at -->

<!-- attribute configurator_url -->
			<?= $form->field($model, 'configurator_url')->textInput(['maxlength' => true]) ?>

<!-- attribute sku -->
			<?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

<!-- attribute extra_info -->
			<?= $form->field($model, 'extra_info')->textInput(['maxlength' => true]) ?>

<!-- attribute affiliate_link_url -->
			<?= $form->field($model, 'affiliate_link_url')->textInput(['maxlength' => true]) ?>
        </p>
        <?php $this->endBlock(); ?>
        
        <?=
    Tabs::widget(
                 [
                    'encodeLabels' => false,
                    'items' => [ 
                        [
    'label'   => Yii::t('shop', 'Variant'),
    'content' => $this->blocks['main'],
    'active'  => true,
],
                    ]
                 ]
    );
    ?>
        <hr/>

        <?php echo $form->errorSummary($model); ?>

        <?= Html::submitButton(
        '<span class="glyphicon glyphicon-check"></span> ' .
        ($model->isNewRecord ? Yii::t('shop', 'Create') : Yii::t('shop', 'Save')),
        [
        'id' => 'save-' . $model->formName(),
        'class' => 'btn btn-success'
        ]
        );
        ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>

