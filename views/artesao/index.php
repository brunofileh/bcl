<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArtesaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Artesaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artesao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Artesao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'nome',
            'uf',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
