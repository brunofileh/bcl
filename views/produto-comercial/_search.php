<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoComercialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-comercial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'desenho_fk') ?>

    <?= $form->field($model, 'classificacao_fk') ?>

    <?= $form->field($model, 'preco_fk') ?>

    <?= $form->field($model, 'produto_fk') ?>

    <?php // echo $form->field($model, 'cor_pano_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
