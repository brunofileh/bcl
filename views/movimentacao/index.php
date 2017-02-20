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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Movimentacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
			'entrada_saida_desc',
            'clienteFk.nome',
			[
				'attribute' => 'data_entrega',
			//	'format' => ['date', 'php:d/m/Y']
			],
            'status_desc',
			'valor_total',
            // 'valor_frete',
            // 'valor_pago',
            // 'parcelas',
            // 'parcela_atual',
            // 'desconto',
            // 'tipo_pagamento',
            // 'canal_venda',
            // 'nome_feira',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
