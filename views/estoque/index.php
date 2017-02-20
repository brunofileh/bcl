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

    <p>
        <?= Html::a('Create Estoque', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
			'id',
			'produto',
            'descricao',
			'qnt_diponivel',
            'valor_unitario',          
			'valor_custo',
			'valor_lucro',
            'pano',
            'bordado',
            'costureira',
            'linha',
            'enchimento',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
