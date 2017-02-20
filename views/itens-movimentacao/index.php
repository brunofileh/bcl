<?php

use yii\helpers\Html;
use yii\grid\GridView;




/* @var $this yii\web\View */
/* @var $searchModel app\models\ItensMovimentacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Itens Movimentacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itens-movimentacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Itens Movimentacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'movimentacao_fk',
            'estoque_fk',
            'valor_desconto',
            'valor_unitario',
            // 'quantidade',
            // 'desenho',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
