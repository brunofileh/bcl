<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Movimentacao */
/* @var $form yii\widgets\ActiveForm */


$js = " 
	var urlInclusao = '" . Url::toRoute('incluir-item') . "';	
	var urlExclusao = '" . Url::toRoute('excluir-item') . "';	
";

$this->registerJs($js, $this::POS_BEGIN);

$client = yii\helpers\ArrayHelper::map(app\models\ClienteSearch::find()->orderBy('nome')->all(), 'id', 'nome');
$status = ['1' => 'Pendente', '2' => 'em andamento', '3' => 'concluido'];
$tpPag = ['1' => 'DINHEIRO', '2' => 'CARTÃO DE DÉBITO', '3' => 'CARTÃO DE CRÉDITO', '4' => 'DEPÓSITO', '5' => 'TRANSFERÊNCIA', '6' => 'CHEQUE'];
$canVendas = ['1' => 'Feira', '2' => 'Encomenda', '3' => 'Internet'];
$entradaSaida = ['1' => 'Entrada', '2' => 'Saída'];
?>

<div class="movimentacao-form">

	<?php $form = ActiveForm::begin(['id' => 'movimentacaoPop']); ?>

	<?= $form->field($model, 'cliente_fk')->dropDownList($client, ['prompt' => 'Selecione']) ?>

	
	
	<?= $form->field($model, 'data_entrega')->widget(
	 \dosamigos\datepicker\DatePicker::className(), [
        // inline too, not bad
      //   'inline' => true, 
		 'language'=>'pt-BR',
         // modify template for custom rendering
     //   'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd/mm/yyyy'
        ]
]);?>

	<?= $form->field($model, 'status')->dropDownList($status) ?>

	<?= $form->field($model, 'valor_frete')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
		'thousands' => '.',
        'decimal' => ',',
			
        'precision' => 2, 
        'allowZero' => false,]
])  ?>

	<?= $form->field($model, 'valor_pago')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
])  ?>

	<?= $form->field($model, 'parcelas')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
        'thousands' => '.',
        'precision' => 0, 
        'allowZero' => false,]
])  ?>

	<?= $form->field($model, 'parcela_atual')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
        'thousands' => '.',
        'precision' => 0, 
        'allowZero' => false,]
])  ?>

	<?= $form->field($model, 'desconto')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
])  ?>

	<?= $form->field($model, 'tipo_pagamento')->dropDownList($tpPag, ['prompt' => 'Selecione']) ?>

	<?= $form->field($model, 'entrada_saida')->dropDownList($entradaSaida, ['prompt' => 'Selecione']) ?>

	<?= $form->field($model, 'canal_venda')->dropDownList($canVendas, ['prompt' => 'Selecione']) ?>

	<?= $form->field($model, 'nome_feira')->textInput(['maxlength' => true]) ?>

	<?php
	echo $this->render('/itens-movimentacao/create', ['form' => $form]);
	?>

    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
