<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use infoweb\catalogue\assets\ProductAsset;

ProductAsset::register($this);
/* @var $this yii\web\View */
/* @var $model infoweb\catalogue\models\product\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php // Flash messages ?>
    <?php echo $this->render('_flash_messages'); ?>

    <?php
    // Init the form
    $form = ActiveForm::begin([
        'id'                        => 'product-form',
        'options'                   => ['class' => 'tabbed-form'],
        'enableAjaxValidation'      => true,
        'enableClientValidation'    => false
    ]);

    // Initialize the tabs
    $tabs = [];

    // Add the main tabs
    $tabs = [
        [
            'label' => Yii::t('ecommerce', 'General'),
            'content' => $this->render('_default_tab', ['model' => $model, 'form' => $form]),
            'active' => true,
            'options' => ['class' => 'fade in']
        ],
        [
            'label' => Yii::t('ecommerce', 'Data'),
            'content' => $this->render('_data_tab', ['model' => $model, 'form' => $form, 'manufacturers' => $manufacturers, 'terms' => $terms, 'selectedTerms' => $selectedTerms]),
            'options' => ['class' => 'fade']
        ],
    ];

    // Display the tabs
    echo Tabs::widget(['items' => $tabs]);
    ?>

    <div class="form-group buttons">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create & close') : Yii::t('app', 'Update & close'), ['class' => 'btn btn-default', 'name' => 'close']) ?>
        <?= Html::submitButton(Yii::t('app', $model->isNewRecord ? 'Create & new' : 'Update & new'), ['class' => 'btn btn-default', 'name' => 'new']) ?>
        <?= Html::a(Yii::t('app', 'Close'), [Yii::$app->session->get('ecommerce.products.view', 'index')], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
