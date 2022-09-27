<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var eluhr\shop\models\Variant $model
*/
$copyParams = $model->attributes;

$this->title = Yii::t('shop', 'Variant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('shop.plural', 'Variant'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('shop', 'View');
?>
<div class="giiant-crud variant-view">

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
        <span class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <?= \Yii::$app->session->getFlash('deleteError') ?>
        </span>
    <?php endif; ?>

    <h1>
        <?= Html::encode($model->label) ?>
        <small>
            <?= Yii::t('shop', 'Variant') ?>
        </small>
    </h1>


    <div class="clearfix crud-navigation">

        <!-- menu buttons -->
        <div class='pull-left'>
            <?php 
 echo Html::a(
            '<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('shop', 'Edit'),
            [ 'update', 'id' => $model->id],
            ['class' => 'btn btn-info'])
          ?>

            <?php 
 echo Html::a(
            '<span class="glyphicon glyphicon-copy"></span> ' . Yii::t('shop', 'Copy'),
            ['create', 'id' => $model->id, 'Variant'=>$copyParams],
            ['class' => 'btn btn-success'])
          ?>

            <?php 
 echo Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('shop', 'New'),
            ['create'],
            ['class' => 'btn btn-success'])
          ?>
        </div>

        <div class="pull-right">
            <?= Html::a('<span class="glyphicon glyphicon-list"></span> '
            . Yii::t('shop', 'Full list'), ['index'], ['class'=>'btn btn-default']) ?>
        </div>

    </div>

    <hr/>

    <?php $this->beginBlock('eluhr\shop\models\Variant'); ?>

    
    <?php 
 echo DetailView::widget([
    'model' => $model,
    'attributes' => [
    // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::attributeFormat
[
    'format' => 'html',
    'attribute' => 'product_id',
    'value' => ($model->product ? 
        Html::a('<i class="glyphicon glyphicon-list"></i>', ['/shop/crud/product/index']).' '.
        Html::a('<i class="glyphicon glyphicon-circle-arrow-right"></i> '.$model->product->title, ['/shop/crud/product/view', 'id' => $model->product->id,]).' '.
        Html::a('<i class="glyphicon glyphicon-paperclip"></i>', ['create', 'Variant'=>['product_id' => $model->product_id]])
        : 
        '<span class="label label-warning">?</span>'),
],
        'title',
        'thumbnail_image',
        'rank',
        'price',
        'hex_color',
        'is_online',
        'include_vat',
        'stock',
        'show_affiliate_link',
        'min_days_shipping_duration',
        'max_days_shipping_duration',
        'discount_price',
        'vat',
        'description:ntext',
        'configurator_data:ntext',
        'created_at',
        'updated_at',
        'configurator_url:url',
        'sku',
        'extra_info',
        'affiliate_link_url:url',
    ],
    ]);
  ?>

    
    <hr/>

    <?php 
 echo Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('shop', 'Delete'), ['delete', 'id' => $model->id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => '' . Yii::t('shop', 'Are you sure to delete this item?') . '',
    'data-method' => 'post',
    ]);
  ?>
    <?php $this->endBlock(); ?>


    
<?php $this->beginBlock('Configurations'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php
        echo Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('shop', 'List All') . ' Configurations',
            ['/shop/crud/configuration/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('shop', 'New') . ' Configurations',
             ['/shop/crud/configuration/create', 'Configuration' => ['variant_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-Configurations', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-Configurations ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getConfigurations(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-configurations',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('shop', 'First'),
        'lastPageLabel'  => Yii::t('shop', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = '/shop/crud/configuration' . '/' . $action;
        $params['Configuration'] = ['variant_id' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => '/shop/crud/configuration'
],
        'id',
        'json:ntext',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('OrderItems'); ?>
<div style='position: relative'>
<div style='position:absolute; right: 0px; top: 0px;'>
  <?php
        echo Html::a(
            '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('shop', 'List All') . ' Order Items',
            ['/shop/crud/order-item/index'],
            ['class'=>'btn text-muted btn-xs']
        ) ?>
  <?= Html::a(
            '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('shop', 'New') . ' Order Items',
             ['/shop/crud/order-item/create', 'OrderItem' => ['variant_id' => $model->id]],
            ['class'=>'btn btn-success btn-xs']
        ); ?>
</div>
</div>
<?php Pjax::begin(['id'=>'pjax-OrderItems', 'enableReplaceState'=> false, 'linkSelector'=>'#pjax-OrderItems ul.pagination a, th a']) ?>
<?=
 '<div class="table-responsive">'
 . \yii\grid\GridView::widget([
    'layout' => '{summary}<div class="text-center">{pager}</div>{items}<div class="text-center">{pager}</div>',
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => $model->getOrderItems(),
        'pagination' => [
            'pageSize' => 20,
            'pageParam'=>'page-orderitems',
        ]
    ]),
    'pager'        => [
        'class'          => yii\widgets\LinkPager::className(),
        'firstPageLabel' => Yii::t('shop', 'First'),
        'lastPageLabel'  => Yii::t('shop', 'Last')
    ],
    'columns' => [
 [
    'class'      => 'yii\grid\ActionColumn',
    'template'   => '{view} {update}',
    'contentOptions' => ['nowrap'=>'nowrap'],
    'urlCreator' => function ($action, $model, $key, $index) {
        // using the column name as key, not mapping to 'id' like the standard generator
        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
        $params[0] = '/shop/crud/order-item' . '/' . $action;
        $params['OrderItem'] = ['variant_id' => $model->primaryKey()[0]];
        return $params;
    },
    'buttons'    => [
        
    ],
    'controller' => '/shop/crud/order-item'
],
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'order_id',
    'value' => function ($model) {
        if ($rel = $model->order) {
            return Html::a($rel->id, ['/shop/crud/order/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
// generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
[
    'class' => yii\grid\DataColumn::className(),
    'attribute' => 'configuration_id',
    'value' => function ($model) {
        if ($rel = $model->configuration) {
            return Html::a($rel->id, ['/shop/crud/configuration/view', 'id' => $rel->id,], ['data-pjax' => 0]);
        } else {
            return '';
        }
    },
    'format' => 'raw',
],
        'name',
        'quantity',
        'extra_info',
        'single_price',
        'single_net_price',
        'vat',
        'created_at',
]
])
 . '</div>' 
?>
<?php Pjax::end() ?>
<?php $this->endBlock() ?>


    <?php 
        echo Tabs::widget(
                 [
                     'id' => 'relation-tabs',
                     'encodeLabels' => false,
                     'items' => [
 [
    'label'   => '<b class=""># '.Html::encode($model->id).'</b>',
    'content' => $this->blocks['eluhr\shop\models\Variant'],
    'active'  => true,
],
[
    'content' => $this->blocks['Configurations'],
    'label'   => '<small>Configurations <span class="badge badge-default">'. $model->getConfigurations()->count() . '</span></small>',
    'active'  => false,
],
[
    'content' => $this->blocks['OrderItems'],
    'label'   => '<small>Order Items <span class="badge badge-default">'. $model->getOrderItems()->count() . '</span></small>',
    'active'  => false,
],
 ]
                 ]
    );
    ?>
</div>
