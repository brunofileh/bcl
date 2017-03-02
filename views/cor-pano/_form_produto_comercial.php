<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;



Modal::begin([
	'headerOptions' => [
		'id' => 'modalHeader'
	],
	'header' => '<h3><div id="tituloInfra">Incluir Cor pano</div><h3>',
	'id' => 'modal-corpano',
	'closeButton' => false,
	'size' => 'modal-lg',
	'footer' =>
	Html::a('Fechar', '#', ['class' => 'btn btn-default', 'id' => 'botaoFechar', 'data-dismiss' => 'modal'])
	. PHP_EOL .
	Html::button('Incluir registro', [
		'id' => 'botaoCorPano',
		'class' => 'btn btn-primary',
	]),
	'clientOptions' => [
		'backdrop' => 'static',
		'keyboard' => FALSE
	]
]);

$model = new app\models\CorPanoSearch();


?>

<div id='form-cor-pano' >
<div id="errorAuxiliares-corpano" style="color:red" class="help-block"></div>
	<?= $form->field($model, 'descricao')->textInput() ?>

</div>

<?php Modal::end(); ?>

