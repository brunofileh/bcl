<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoPreco */

$this->title = 'Update Produto Preco: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produto Precos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produto-preco-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?=
	$this->render('_form', [
		'model' => $model,
		'produto' => $produto,
		'cor' => $cor
	])
	?>

</div>
