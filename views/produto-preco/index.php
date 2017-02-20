<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoPrecoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produto Precos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-preco-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Produto Preco', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'produto_fk',
            'data_inclusao',
            'risco',
            'pano',
            // 'linha',
            // 'bordado',
            // 'costureira',
            // 'enchimento',
            // 'cor_pano_fk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
