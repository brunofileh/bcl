<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Movimentacao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Movimentacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimentacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?php
			if($model['status'] != 3) { 
				Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
			} 
		?>
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
			'id',
			'clienteFk.nome',
			'data_entrega',
			'data_inclusao',
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
							'nome_feira',
							'valor_frete',
							'valor_pago',
							'parcelas',
							'parcela_atual',
							'desconto',
							'valor_total',
						],
					])
					?>

				</div>

				<div id="divGridItens" class='gride' style="display: block">

					<?=
					yii\grid\GridView::widget([
						'dataProvider' => app\models\ItensMovimentacaoSearch::buscaCampos($itens),
						//'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],
							'descricao_produto',
							'valor_desconto',
							'valor_unitario',
							'quantidade',
							'valor_total'
						],
					]);
					?>
</div>