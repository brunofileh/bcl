<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FabricacaoHistoricoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fabricacao-historico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'data_conclusao') ?>

    <?= $form->field($model, 'pessoa') ?>

    <?= $form->field($model, 'qnt') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'pago_status')->checkbox() ?>

    <?php // echo $form->field($model, 'fabricacao_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
