<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstoqueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estoques';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estoque-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'produto_comercial',
            'qnt_disponivel',
            'valor_custo',
            'valor_comercial',
                ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($urls, $model, $class) {

                        return Html::a(
                                        '<span class="glyphicon glyphicon-eye-open"> </span>', yii\helpers\Url::to(['view', 'id' => $model['id']]), [
                                    'data-toggle' => 'tooltip',
                                    'title' => 'Visualizar',
                                    'data-pjax' => '0',
                                        ]
                        );
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
