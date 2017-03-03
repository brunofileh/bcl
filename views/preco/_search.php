<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrecoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="preco-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'risco') ?>

    <?= $form->field($model, 'pano') ?>

    <?= $form->field($model, 'linha') ?>

    <?php // echo $form->field($model, 'bordado') ?>

    <?php // echo $form->field($model, 'costureira') ?>

    <?php // echo $form->field($model, 'enchimento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
