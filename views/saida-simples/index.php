<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SaidaSimplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saida Simples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saida-simples-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a('Create Saida Simples', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
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

				['class' => 'yii\grid\ActionColumn'],
			],
		]);
		?>
</div>
