<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoItensSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terceirizado-itens-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'produto_fk') ?>

    <?= $form->field($model, 'data_inclusao') ?>

    <?= $form->field($model, 'data_entrega') ?>

    <?= $form->field($model, 'valor') ?>

    <?php // echo $form->field($model, 'classificacao_fk') ?>

    <?php // echo $form->field($model, 'quantidade') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'equipe') ?>

    <?php // echo $form->field($model, 'desenho') ?>

    <?php // echo $form->field($model, 'terceirizado_lote_fk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
