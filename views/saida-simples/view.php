<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SaidaSimples */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Saida Simples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saida-simples-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?=
		Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		])
		?>
    </p>

	<?=
	DetailView::widget([
		'model' => $model,
		'attributes' => [
			[
				'attribute' => 'entrada_saida',
				'value' => function ($model) {
					$entradaSaida = ['1' => 'Entrada', '2' => 'Saída'];
					return $entradaSaida[$model->entrada_saida];
				},
				],
				'descricao',
				'valor',
				'data_saida',
				'data_inclusao',
			],
		])
		?>

</div>
