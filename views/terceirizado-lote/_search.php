<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoLoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terceirizado-lote-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'data_lote_fechamento') ?>

    <?= $form->field($model, 'quantidade') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'equipe') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
