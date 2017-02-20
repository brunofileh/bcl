<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Fabricacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-view">

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
			'produtoPrecoFk.produtoFk.descricao',
			'desenhoFk.descricao',
			'classificacaoFk.descricao',
			'qnt',
			[
				'attribute' => 'status',
				'value' => function ($model) {
					$status = [1 => 'Riscado', 2 => 'Bordando Terceiros', 3 => 'Bordado', 4 => 'Pronto'];

					return $status[$model['status']];
				}
				],
			],
		])
		?>


		<br />
		<br />
<?=
	$this->render('_form_status', [
		'model' => $modelNovo,
		'produto' => $produto,
		'classificacao' => $classificacao,
		'desenho' => $desenho,
		'status' => $status,
			'modelHitorico' => $modelHitorico,
	])
	?>

                <br />
		<br />


		<?=
		\yii\grid\GridView::widget([
			'dataProvider' => app\models\FabricacaoHistoricoSearch::buscaHistorico($model->id),
			//'filterModel' => $searchModel,
			'columns' => [
				[
					'attribute' => 'status',
					'value' => function ($model) {
						$status = [1 => 'Entrada', 2 => 'Saida'];

						return $status[$model['status']];
					}
					],
					'qnt',
					'pessoa',
					'data_inclusao',
					'pago_status:boolean',
					'data_conclusao',
					// 'fabricacao_fk',
					[
						'class' => 'yii\grid\ActionColumn',
						'template' => '{update}',
						'buttons' => [
							'update' => function ($urls, $model) {
								return Html::a('<span class="glyphicon glyphicon-edit"> </span>', yii\helpers\Url::to(['fabricacao-historico/update', 'id' => $model['id']]), [
										'data-toggle' => 'tooltip',
										'title' => 'Alterar',
										'data-pjax' => '0',
								]);
							},
							]
						],
					],
				]);
				?>


</div>
