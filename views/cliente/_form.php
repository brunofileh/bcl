<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnpj_cpf')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' =>['999.999.999-99','99.999.999/9999-99'],
]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' =>['(99) 9999-9999', '(99) 99999-9999'],
]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' =>['(99) 9999-9999', '(99) 99999-9999'],
]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cep')->textInput(['maxlength' => true])->widget(\yii\widgets\MaskedInput::className(), [
    'mask' =>['99.999-999'],
]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
