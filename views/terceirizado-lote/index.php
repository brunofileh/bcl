<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TerceirizadoLoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terceirizado Lotes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceirizado-lote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Terceirizado Lote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_inclusao',
            'data_lote_fechamento',
            'quantidade',
            'status',
            // 'equipe',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
