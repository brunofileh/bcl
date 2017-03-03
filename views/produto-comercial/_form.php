<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoComercial */
/* @var $form yii\widgets\ActiveForm */
$js = " 
var urlDesenho = '" . \yii\helpers\Url::toRoute('incluir-desenho') . "';	
var urlClassificacao = '" . \yii\helpers\Url::toRoute('incluir-classificacao') . "';	
var urlProduto = '" . \yii\helpers\Url::toRoute('incluir-produto') . "';	
var urlCorPano = '" . \yii\helpers\Url::toRoute('incluir-cor-pano') . "';	
";

$this->registerJs($js, $this::POS_BEGIN);

$this->registerJsFile('@web/js/produto_comercial.js', ['position' => $this::POS_END, 'depends' => [\app\assets\AppAsset::className()]]);
?>


<div class="produto-comercial-form">

	<?php
	$form = ActiveForm::begin(['id' => 'form-produto_comercial']);

	echo $form->field($model, 'preco_fk')->hiddenInput()->label(false);
	?>



	<div class="row">
        <div class="col-md-11">
			<?=
			$form->field($model, 'produto_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
				'id' => 'produto_fk',
				'data' => $produto,
				'size' => \kartik\select2\Select2::MEDIUM,
				//'disabled' => (($model->id) ? true : false),
				'options' => [
					'placeholder' => '-- selecione --',
				//'multiple' => true,
				],
				'toggleAllSettings' => [
					'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Selecionar todos',
					'unselectLabel' => '<i class="glyphicon glyphicon-check"></i> Remover todos',
				],
				'pluginOptions' => [
					'allowClear' => true,
				],
			])
			?>
        </div>
        <div class="col-md-1">
			<?= Html::button(' + ', ['class' => 'btn btn-success', 'id' => 'incluir-produto']) ?>
        </div>
		<?php echo $this->render('/produto/_form_produto_comercial', ['form' => $form]); ?>
    </div>


	<div class="row">

        <div class="col-md-11">
			<?=
			$form->field($model, 'cor_pano_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
				'id' => 'cor_pano_fk',
				'data' => $corPano,
				'size' => \kartik\select2\Select2::MEDIUM,
				//'disabled' => (($model->id) ? true : false),
				'options' => [
					'placeholder' => '-- selecione --',
				//'multiple' => true,
				],
				'toggleAllSettings' => [
					'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Selecionar todos',
					'unselectLabel' => '<i class="glyphicon glyphicon-check"></i> Remover todos',
				],
				'pluginOptions' => [
					'allowClear' => true,
				],
			])
			?> 
        </div>
        <div class="col-md-1">
			<?= Html::button(' + ', ['class' => 'btn btn-success', 'id' => 'incluir-cor-pano']) ?>
        </div>
		<?php echo $this->render('/cor-pano/_form_produto_comercial', ['form' => $form]); ?>
    </div>

	<div class="row">

        <div class="col-md-11">
			<?=
			$form->field($model, 'desenho_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
				'id' => 'desenho_fk',
				'data' => $desenho,
				'size' => \kartik\select2\Select2::MEDIUM,
				//'disabled' => (($model->id) ? true : false),
				'options' => [
					'placeholder' => '-- selecione --',
				//'multiple' => true,
				],
				'toggleAllSettings' => [
					'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Selecionar todos',
					'unselectLabel' => '<i class="glyphicon glyphicon-check"></i> Remover todos',
				],
				'pluginOptions' => [
					'allowClear' => true,
				],
			])
			?> 
        </div>
        <div class="col-md-1">
			<?= Html::button(' + ', ['class' => 'btn btn-success', 'id' => 'incluir-desenho']) ?>
        </div>
		<?php echo $this->render('/desenho/_form_produto_comercial', ['form' => $form]); ?>
    </div>

    <div class="row">
        <div class="col-md-11">
			<?=
			$form->field($model, 'classificacao_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
				'id' => 'classificacao_fk',
				'data' => $classificacao,
				'size' => \kartik\select2\Select2::MEDIUM,
				//'disabled' => (($model->id) ? true : false),
				'options' => [
					'placeholder' => '-- selecione --',
				//'multiple' => true,
				],
				'toggleAllSettings' => [
					'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Selecionar todos',
					'unselectLabel' => '<i class="glyphicon glyphicon-check"></i> Remover todos',
				],
				'pluginOptions' => [
					'allowClear' => true,
				],
			])
			?></div>
        <div class="col-md-1">
			<?= Html::button(' + ', ['class' => 'btn btn-success', 'id' => 'incluir-classificacao']) ?>
        </div>
		<?php echo $this->render('/classificacao/_form_produto_comercial', ['form' => $form]); ?>
    </div>

	<div>
		<div id='divPreco' style="display:none">
			<?php
			$preco = new app\models\PrecoSearch();
			echo $this->render('/preco/_form', ['form' => $form, 'model' => $preco]);
			?>
		</div>
		<div>			
			<?= Html::button(' Informar Preço ', ['class' => 'btn btn-success', 'id' => 'desvincular']) ?>
		</div>
		<div id='divGridPreco' >
			<?php echo $this->render('/preco/_grid_preco', ['modelVis' => $modelVis, 'produto_preco' => $produto_preco]); ?>
		</div>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
