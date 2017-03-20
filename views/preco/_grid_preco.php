<?php

use yii\widgets\Pjax;
?>

<div>

	<?php
	Pjax::begin(['id' => 'grid_precos']);

	echo \yii\grid\GridView::widget([
		'dataProvider' => $produto_preco,
		//'filterModel' => $modelVis,
		'columns' => [	

			[
				'class' => 'yii\grid\RadioButtonColumn',
				'name' => 'VisProdutoComercialSearch[id]',
				'radioOptions' => function ($data, $key, $index, $column) {
					return [
						'id' => 'visprodutocomercialsearch-preco_fk_' . $data->preco_fk,
						'value' => $data->id,
						'onclick' => 'HabilitarBotao(' . $data->preco_fk . ')'
					];
				},
				],
				'produto',
				'cor_pano',
				'desenho',
				'risco',
				'pano',
				'linha',
				'bordado',
				'costureira',
				'enchimento',
					'valor_custo'
		
			],
		]);

		Pjax::end();
		?>
</div>