
<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



Modal::begin([
	'headerOptions' => [
		'id' => 'modalHeader'
	],
	'header' => '<h3><div id="tituloInfra">Incluir Classificacao</div><h3>',
	'id' => 'modalClassificacao',
	'closeButton' => false,
	'size' => 'modal-lg',
	'footer' =>
	Html::a('Fechar', '#', ['class' => 'btn btn-default', 'id' => 'botaoFechar', 'data-dismiss' => 'modal'])
	. PHP_EOL .
	Html::button('Incluir registro', [
		'id' => 'botaoClassificacao',
		'class' => 'btn btn-primary',
	]),
	'clientOptions' => [
		'backdrop' => 'static',
		'keyboard' => FALSE
	]
]);

$model = new app\models\ClassificacaoSearch();
$subClass = yii\helpers\ArrayHelper::map(app\models\ClassificacaoSearch::find()->orderBy('descricao')->all(), 'id', 'descricao');

?>


<div class="formClassificacao">


    <?= $form->field($model, 'descricao')->textInput() ?>

    <?= $form->field($model, 'fk_classificacao')->dropDownList($subClass,  ['prompt' => 'Selecione']) ?>


</div>

<?php Modal::end(); ?>