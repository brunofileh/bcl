<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */

$this->title = 'Update Fabricacao: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fabricacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fabricacao-update">

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
