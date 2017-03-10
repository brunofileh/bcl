<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

Modal::begin([
	'headerOptions' => [
		'id' => 'modalHeader'
	],
	'header' => '<h3><div id="tituloInfra">Incluir Itens</div><h3>',
	'id' => 'modalItens',
	'closeButton' => false,
	'size' => 'modal-lg',
	'footer' =>
	Html::a('Fechar', '#', ['class' => 'btn btn-default', 'id' => 'botaoFechar', 'data-dismiss' => 'modal'])
	. PHP_EOL .
	Html::button('Incluir registro', [
		'id' => 'botaoSalvar',
		'class' => 'btn btn-primary',
	]),
	'clientOptions' => [
		'backdrop' => 'static',
		'keyboard' => FALSE
	]
]);
$status = ['1' => 'Pendente', '2' => 'baixado'];
$model = new app\models\ItensMovimentacaoSearch();

$estoque = yii\helpers\ArrayHelper::map(app\models\VisEstoqueSearch::find()->select("id, produto_comercial")->where('qnt_disponivel>0')->orderBy('produto_comercial')->all(), 'id', 'produto_comercial');
?>

<div id='formItens' >

	<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
	<?= $form->field($model, 'novo')->hiddenInput()->label(false); ?>
	<?= $form->field($model, 'qnt_estoque')->hiddenInput()->label(false); ?>

	<?= $form->field($model, 'estoque_fk')->dropDownList($estoque, ['prompt' => 'Selecione']) ?>

		

	<?php echo $form->field($model, 'valor_unitario')->textInput(['readonly' => 'readonly']); ?>

	<?=
	$form->field($model, 'valor_desconto')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions' => [
			'thousands' => '.',
			'decimal' => ',',
			'precision' => 2,
			'allowZero' => false,]
	])
	?>



	<?=
	$form->field($model, 'quantidade')->textInput();
	?>
	<div id="qnt_estoque"></div> <br />
		
	<?php echo $form->field($model, 'valor_total')->textInput(['readonly' => 'readonly']); ?>
	<?= $form->field($model, 'status')->dropDownList($status) ?>

</div>

<?php Modal::end(); ?>

