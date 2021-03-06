<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

use infoweb\catalogue\assets\ProductAsset;

/* @var $this yii\web\View */
/* @var $searchModel infoweb\catalogue\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('ecommerce', 'Products');
$this->params['breadcrumbs'][] = $this->title;

ProductAsset::register($this);
?>
<div class="product-index">

    <?php // Title ?>
    <h1>
        <?= Html::encode($this->title) ?>

        <?= Html::a('(' . Yii::t('ecommerce', 'Show as structured list') . ')', ['tree'], ['class' => 'small text-muted']); ?>
        <?php // Buttons ?>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Create {modelClass}', [
                'modelClass' => Yii::t('ecommerce', 'Product'),
            ]), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </h1>

    <?php // Flash messages ?>
    <?php echo $this->render('_flash_messages'); ?>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => 'name'
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete} {active} {image} {duplicate}',
                'buttons' => [
                    'active' => function ($url, $model) {
                        if ($model->active == true) {
                            $icon = 'glyphicon-eye-open';
                        } else {
                            $icon = 'glyphicon-eye-close';
                        }

                        return Html::a('<span class="glyphicon ' . $icon . '"></span>', $url, [
                            'title' => Yii::t('app', 'Toggle active'),
                            'data-pjax' => '0',
                            'data-toggleable' => 'true',
                            'data-toggle-id' => $model->id,
                            'data-toggle' => 'tooltip',
                        ]);
                    },
                    'image' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-picture"></span>', $url, [
                            'title' => Yii::t('infoweb/cms', 'Images'),
                            'data-pjax' => '0',
                            'data-toggle' => 'tooltip',
                        ]);
                    },
                ],
                'urlCreator' => function($action, $model, $key, $index) {
                    if ($action === 'image') {
                        return Url::toRoute(['/gallery/gallery-image', 'gallery-id' => $model->id]);
                    } else {
                        return Url::toRoute([$action, 'id' => $key]);
                    }
                },
                'updateOptions' => ['title' => Yii::t('app', 'Update'), 'data-toggle' => 'tooltip'],
                'deleteOptions' => ['title' => Yii::t('app', 'Delete'), 'data-toggle' => 'tooltip'],
                'width' => '160px',
            ],
        ],
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'id' => "grid-pjax",
            ],
        ],
        'responsive' => true,
        'floatHeader' => true,
        // @todo Create scrollingTop constant/setting
        'floatHeaderOptions' => ['scrollingTop' => 88],
        'hover' => true,
    ]); ?>

</div>