<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FabricacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fabricacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fabricacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'produtoPrecoFk.produtoFk.descricao',
            'classificacaoFk.descricao',
            
            'desenhoFk.descricao',
             'qnt',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
