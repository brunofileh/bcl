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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cliente_fk',
            'data_entrega',
            'data_inclusao',
            'status',
            'valor_frete',
            'valor_pago',
            'parcelas',
            'parcela_atual',
            'desconto',
            'tipo_pagamento',
            'entrada_saida',
            'canal_venda',
            'nome_feira',
        ],
    ]) ?>

</div>

 <div id="divGridItens" class='gride' style="display: block">
       
<?= yii\grid\GridView::widget([
        'dataProvider' => app\models\ItensMovimentacaoSearch::buscaCampos($itens),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

     
            'valor_desconto',
            'valor_unitario',
            'quantidade',
            'desenho',

            [
			'class' => 'yii\grid\ActionColumn',
		//template' => '{view} {update} {delete}',	
			'buttons' => false,
								
				
				],
        ],
    ]); ?>
    </div>