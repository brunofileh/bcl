<?php
use yii\helpers\Html;
use yii\helpers\Url;


?>
<div class="row">
	<?php if (isset($msg)) { ?>
		<div class="col-md-12">
			<div class="alert-<?= $msg['tipo'] ?> alert fade in">
				<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
				<i class="icon fa fa-<?= $msg['icon'] ?>"></i>
				<?= $msg['msg'] ?>
			</div>
		</div>
	<?php } ?>
	<div class="col-lg-12"> 

<?= yii\grid\GridView::widget([
        'dataProvider' => app\models\ItensMovimentacaoSearch::buscaCampos(),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'movimentacao_fk',
            'estoque_fk',
            'valor_desconto',
            'valor_unitario',
            // 'quantidade',
            // 'desenho',

            [
			'class' => 'yii\grid\ActionColumn',
			'template' => '{view} {update} {delete}',	
			'buttons' => [
							'view' => function ($urls, $key, $class) {
								$dados = \yii\helpers\Json::encode($key);
								//print_r($dados); exit;
								return Html::a(
										'<span class="glyphicon glyphicon-eye-open"> </span>', '#', [
										'data-toggle' => 'tooltip',
										'title' => 'Exibir',
										'data-pjax' => '0',
										'onclick' => " 
											var dados = {$dados};
											openModal();
											limpaForm();
											preencheForm(dados, 'view');
											return false;
											"
										]
								);
							},
								'update' => function ($urls, $key, $class) {
								
									$dados = \yii\helpers\Json::encode($key);
									return Html::a(
											'<span class="glyphicon glyphicon-pencil"> </span>', '#', [
											'data-toggle' => 'tooltip',
											'title' => 'Alterar',
											'data-pjax' => '0',
											'onclick' => " 
							var dados = {$dados};
							openModal();
							preencheForm(dados, 'update');
							return false;
							"
											]
									);
								
							},
								'delete' => function ($urls, $key, $class) {
								
									$dados = \yii\helpers\Json::encode($key);

									return Html::a(
											'<span class="glyphicon glyphicon-trash"> </span>', '#', [
											'data-toggle' => 'tooltip',
											'title' => 'Excluir',
											'data-pjax' => '0',
											'onclick' => "	
							yii.confirm('" . Yii::t('yii', 'Are you sure you want to delete this item?') . "', function (){
								$.ajax({
									 url: '" . Url::toRoute(['excluir-item', 'id'=>(($key['id']) ? $key['id'] : $key['novo'])]) . "',
									 type: 'post',
									 success: function (response) {
									 var dados = $.parseJSON(response);
									 $('#divGridItens').html(dados.grid);
									 
									}
								});
							}, function () {
							  return false;
							});
							return false;
						"
											]
									);
								}
							,
							]	
				
				],
        ],
    ]); ?>

			</div>
</div>