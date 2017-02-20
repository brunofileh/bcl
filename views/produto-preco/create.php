<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoPreco */

$this->title = 'Create Produto Preco';
$this->params['breadcrumbs'][] = ['label' => 'Produto Precos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-preco-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?=
	$this->render('_form', [
		'model' => $model,
		'produto' => $produto,
		'cor' => $cor
	])
	?>

</div>
