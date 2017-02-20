<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoLote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terceirizado-lote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_inclusao')->textInput() ?>

    <?= $form->field($model, 'data_lote_fechamento')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'equipe')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
