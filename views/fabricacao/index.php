<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FabricacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?= Html::a('Create Fabricacao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'produto_comercial',
			'qnt',
			'status_descricao',
			'data_inclusao',
			['class' => 'yii\grid\ActionColumn',
				'template' => '{view} {mudar} {delete}',
				'buttons' => [
					'view' => function ($urls, $model, $class) {

						return Html::a(
								'<span class="glyphicon glyphicon-eye-open"> </span>', yii\helpers\Url::to(['view', 'id' => $model['id']]), [
								'data-toggle' => 'tooltip',
								'title' => 'Visualizar',
								'data-pjax' => '0',
								]
						);
					},
						'mudar' => function ($urls, $model, $class) {

						return Html::a(
								'<span class="glyphicon glyphicon-edit"> </span>', yii\helpers\Url::to(['muda-status', 'id' => $model['id']]), [
								'data-toggle' => 'tooltip',
								'title' => 'Mudar status',
								'data-pjax' => '0',
								]
						);
					},
						'delete' => function ($urls, $model, $class) {

						return Html::a(
								'<span class="glyphicon glyphicon-trash"> </span>', yii\helpers\Url::to(['delete', 'id' => $model['id']]), [
								'data-toggle' => 'tooltip',
								'title' => 'Excluir',
								'data-pjax' => '0',
								'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
								'data-method' => 'post',
								]
						);
					},
					],
				],
			],
		]);
		?>
</div>
