<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProdutoComercialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produto Comercials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-comercial-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a('Create Produto Comercial', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'produto',
			'cor_pano',
			'classificacao',
			'desenho',
			'valor_custo',
			['class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {delete}',
				'buttons' => [
					'view' => function ($urls, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"> </span>', yii\helpers\Url::to(['view', 'id' => $model->id]), [
								'data-toggle' => 'tooltip',
								'title' => 'Visualizar',
								'data-pjax' => '0',
						]);
					},
						'update' => function ($urls, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"> </span>', yii\helpers\Url::to(['update', 'id' => $model->id]), [
								'data-toggle' => 'tooltip',
								'title' => 'Alterar',
								'data-pjax' => '0',
						]);
					},
						'delete' => function ($urls, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"> </span>', yii\helpers\Url::to(['delete', 'id' => $model->id]), [
								'data-toggle' => 'tooltip',
								'title' => 'Excluir',
								'data-pjax' => '0',
								'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
								'data-method' => 'post',
						]);
					},
					],
				]
			],
		]);
		?>
</div>
