<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */
/* @var $form yii\widgets\ActiveForm */

$produto = yii\helpers\ArrayHelper::map(app\models\ProdutoSearch::find()->orderBy('descricao')->all(), 'id', 'descricao');
$class = yii\helpers\ArrayHelper::map(app\models\ClassificacaoSearch::find()->orderBy('descricao')->all(), 'id', 'descricao');
?>

<div class="estoque-form">

    <?php $form = ActiveForm::begin(); ?>


	 <?= $form->field($model, 'produto_fk')->dropDownList($produto) ?>
	 <?= $form->field($model, 'classificacao_fk')->dropDownList($class) ?>
	
    <?= $form->field($model, 'valor_unitario')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
]) ?>

    <?= $form->field($model, 'qnt_minimo')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
        'thousands' => '.',
        'precision' => 0, 
        'allowZero' => false,]
])  ?>

    <?= $form->field($model, 'pano')->textInput()->widget(\kartik\money\MaskMoney::className(), [
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

    <?= $form->field($model, 'linha')->textInput()->widget(\kartik\money\MaskMoney::className(), [
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

   
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
