<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TerceirizadoItensSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terceirizado Itens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceirizado-itens-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Terceirizado Itens', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'produto_fk',
            'data_inclusao',
            'data_entrega',
            'valor',
            // 'classificacao_fk',
            // 'quantidade',
            // 'status',
            // 'equipe',
            // 'desenho',
            // 'terceirizado_lote_fk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
