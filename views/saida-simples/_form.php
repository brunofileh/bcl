<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SaidaSimples */
/* @var $form yii\widgets\ActiveForm */
$entradaSaida = ['1' => 'Entrada', '2' => 'Saída'];
?>

<div class="saida-simples-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'entrada_saida')->dropDownList($entradaSaida, ['disabled'=>($model->isNewRecord ? false : true)]) ?>
    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

	 <?=
        $form->field($model, 'data_saida')->widget(
                \dosamigos\datepicker\DatePicker::className(), [
            // inline too, not bad
            //   'inline' => true, 
            'language' => 'pt-BR',
            // modify template for custom rendering
            //   'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd/mm/yyyy'
            ]
        ]);
        ?>
	
	 <?=
        $form->field($model, 'valor')->textInput()->widget(\kartik\money\MaskMoney::className(), [
            'pluginOptions' => [
                'thousands' => '.',
                'decimal' => ',',
                'precision' => 2,
                'allowZero' => false,]
        ])
        ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Incluir' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
