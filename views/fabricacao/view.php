<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */

$this->params['breadcrumbs'][] = ['label' => 'Lista Produtos Fabricação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Altera Estágio de Fabricação', ['muda-status', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'produto_comercial_fk',
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
//					'data_conclusao',
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
