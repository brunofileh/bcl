<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FabricacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fabricacaos';
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
			['class' => 'yii\grid\SerialColumn'],
			'produto',
			'desenho',
			'classificacao',
			'qnt',
			'status',
			['class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {mudar_status}',
				'buttons' => [
					'mudar_status' => function ($urls, $model) {
						return Html::a('<span class="glyphicon glyphicon-edit"> </span>', yii\helpers\Url::to(['muda-status', 'id' => $model['id']]), [
								'data-toggle' => 'tooltip',
								'title' => 'Mudar status',
								'data-pjax' => '0',
						]);
					},
					],
				]
			],
		]);
		?>
</div>
