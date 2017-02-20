<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FabricacaoHistoricoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fabricacao Historicos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-historico-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fabricacao Historico', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_inclusao',
            'data_conclusao',
            'pessoa',
            'qnt',
            // 'status',
            // 'pago_status:boolean',
            // 'fabricacao_fk',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
