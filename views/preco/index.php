<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrecoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Precos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="preco-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Preco', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data_inclusao',
            'risco',
            'pano',
            'linha',
            // 'bordado',
            // 'costureira',
            // 'enchimento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
