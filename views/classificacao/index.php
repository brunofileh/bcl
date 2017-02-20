<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClassificacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Classificacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classificacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Classificacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],
            'descricao',
            'fkClassificacao.descricao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
