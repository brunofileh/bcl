<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoItens */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="terceirizado-itens-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produto_fk')->textInput() ?>

    <?= $form->field($model, 'data_inclusao')->textInput() ?>

    <?= $form->field($model, 'data_entrega')->textInput() ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'classificacao_fk')->textInput() ?>

    <?= $form->field($model, 'quantidade')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'equipe')->textInput() ?>

    <?= $form->field($model, 'desenho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'terceirizado_lote_fk')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
