<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MovimentacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Movimentacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimentacao-index" id='movimentacao-index'>

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
		<?= Html::a('Create Movimentacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
	//	'filterModel' => $searchModel,
		'columns' => [
			'entrada_saida_desc',
			'clienteFk.nome',
			[
				'attribute' => 'data_entrega',
			//	'format' => ['date', 'php:d/m/Y']
			],
			'status_desc',
			[
				'attribute' => 'status',
				'value' => function ($model) {
					$status = ['1' => 'Pendente', '2' => 'em andamento', '3' => 'concluido'];

					return $status[$model->status];
				},
				],
				[
					'attribute' => 'tipo_pagamento',
					'value' => function ($model) {
						$tpPag = ['1' => 'DINHEIRO', '2' => 'CARTÃO DE DÉBITO', '3' => 'CARTÃO DE CRÉDITO', '4' => 'DEPÓSITO', '5' => 'TRANSFERÊNCIA', '6' => 'CHEQUE'];

						return $tpPag[$model->tipo_pagamento];
					},
					],
					[
						'attribute' => 'entrada_saida',
						'value' => function ($model) {
							$entradaSaida = ['1' => 'Entrada', '2' => 'Saída'];
							return $entradaSaida[$model->entrada_saida];
						},
						],
						[
							'attribute' => 'canal_venda',
							'value' => function ($model) {
								$canVendas = ['1' => 'Feira', '2' => 'Encomenda', '3' => 'Internet'];

								return $canVendas[$model->canal_venda];
							},
							],
			
			[
				'attribute' => 'valor_total',
				'value' => function ($model) {
					$itens = \app\models\ItensMovimentacaoSearch::find()->where("movimentacao_fk={$model->id}")->asArray()->all();
		
					foreach ($itens as $value) {
							$model->valor_total += ($value['valor_unitario'] * $value['quantidade'])- ( $value['valor_desconto'] * $value['quantidade']);
					}	
		
					return $model->valor_total;
				},
			
				],
				['class' => 'yii\grid\ActionColumn'
					, 'template' => '{view} {update} {delete}',
					'buttons' => [
						'update' => function ($urls, $model, $class) {
							if (($model['status'] != 3)) {
								return Html::a(
										'<span class="glyphicon glyphicon-edit"> </span>', yii\helpers\Url::to(['update', 'id' => $model['id']]), [
										'data-toggle' => 'tooltip',
										'title' => 'Alterar',
										'	data-pjax' => '0',
										]
								);
							}
						},
						],
					],
				],
			]);
			?>
</div>
