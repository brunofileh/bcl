<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EstoqueSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estoque-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'produto_fk') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'valor_custo') ?>

    <?= $form->field($model, 'valor_unitario') ?>

    <?php // echo $form->field($model, 'qnt_diponivel') ?>

    <?php // echo $form->field($model, 'qnt_minimo') ?>

    <?php // echo $form->field($model, 'pano') ?>

    <?php // echo $form->field($model, 'bordado') ?>

    <?php // echo $form->field($model, 'costureira') ?>

    <?php // echo $form->field($model, 'linha') ?>

    <?php // echo $form->field($model, 'enchimento') ?>

    <?php // echo $form->field($model, 'classificacao_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
