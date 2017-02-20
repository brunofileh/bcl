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
$status = ['1'=>'Pendente', '2'=>'baixado'];
$model = new app\models\ItensMovimentacaoSearch();

$estoque = yii\helpers\ArrayHelper::map(app\models\VisEstoquesSearch::find()->select("id,(produto || ' ' || descricao) as produto")->where('qnt_diponivel>0')->orderBy('produto')->all(), 'id', 'produto');

?>

<div id='formItens' >

		<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
		<?= $form->field($model, 'novo')->hiddenInput()->label(false); ?>
	
	 <?= $form->field($model, 'estoque_fk')->dropDownList($estoque, ['prompt' => 'Selecione']) ?>

	<?= $form->field($model, 'valor_desconto')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
])  ?>

	<?= $form->field($model, 'valor_unitario')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
           'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,]
])  ?>
	
	<?= $form->field($model, 'quantidade')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions'=>[
        'thousands' => '.',
        'precision' => 0, 
        'allowZero' => false,]
]) ?>

	<?= $form->field($model, 'desenho')->textInput() ?>
	
    <?= $form->field($model, 'status')->dropDownList($status) ?>

</div>

<?php Modal::end(); ?>

