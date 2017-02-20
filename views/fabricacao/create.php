<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */

$this->title = 'Create Fabricacao';
$this->params['breadcrumbs'][] = ['label' => 'Fabricacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?=
	$this->render('_form', [
		'model' => $model,
		'produto' => $produto,
		'classificacao' => $classificacao,
		'desenho' => $desenho,
		'status' => $status,
			'modelHitorico' => $modelHitorico,
	])
	?>

</div>
