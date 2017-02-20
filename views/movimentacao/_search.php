<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MovimentacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="movimentacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cliente_fk') ?>

    <?= $form->field($model, 'data_entrega') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'valor_frete') ?>

    <?php // echo $form->field($model, 'valor_pago') ?>

    <?php // echo $form->field($model, 'parcelas') ?>

    <?php // echo $form->field($model, 'parcela_atual') ?>

    <?php // echo $form->field($model, 'desconto') ?>

    <?php // echo $form->field($model, 'tipo_pagamento') ?>

    <?php // echo $form->field($model, 'entrada_saida') ?>

    <?php // echo $form->field($model, 'canal_venda') ?>

    <?php // echo $form->field($model, 'nome_feira') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
