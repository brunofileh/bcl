<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BalanceteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="balancete-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'entrada') ?>

    <?= $form->field($model, 'saida') ?>

    <?= $form->field($model, 'total') ?>

    <?= $form->field($model, 'lucro') ?>

    <?php // echo $form->field($model, 'mes_ano') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
