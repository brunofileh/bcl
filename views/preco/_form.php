<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Preco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preco-form">

    <?= $form->field($model, 'risco')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

    <?= $form->field($model, 'pano')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

    <?= $form->field($model, 'linha')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

    <?= $form->field($model, 'bordado')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

    <?= $form->field($model, 'costureira')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

    <?= $form->field($model, 'enchimento')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

</div>
