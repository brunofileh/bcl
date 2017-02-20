<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FabricacaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fabricacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'classificacao_fk') ?>

    <?= $form->field($model, 'produto_preco_fk') ?>

    <?= $form->field($model, 'desenho') ?>

    <?php // echo $form->field($model, 'qnt') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
