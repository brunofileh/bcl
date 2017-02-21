<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



Modal::begin([
	'headerOptions' => [
		'id' => 'modalHeader'
	],
	'header' => '<h3><div id="tituloInfra">Incluir Desenho</div><h3>',
	'id' => 'modalDesenho',
	'closeButton' => false,
	'size' => 'modal-lg',
	'footer' =>
	Html::a('Fechar', '#', ['class' => 'btn btn-default', 'id' => 'botaoFechar', 'data-dismiss' => 'modal'])
	. PHP_EOL .
	Html::button('Incluir registro', [
		'id' => 'botaoDesenho',
		'class' => 'btn btn-primary',
	]),
	'clientOptions' => [
		'backdrop' => 'static',
		'keyboard' => FALSE
	]
]);

$model = new app\models\DesenhoSearch();


?>

<div id='formDesenho' >

	<?= $form->field($model, 'descricao')->textInput() ?>

</div>

<?php Modal::end(); ?>

