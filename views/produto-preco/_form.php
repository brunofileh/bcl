<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoPreco */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('@web/js/produto_preco.js', ['position' => $this::POS_END, 'depends' => [\app\assets\AppAsset::className()]]);
?>



<div class="produto-preco-form">

	<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'id')->hiddenInput()->label(false); ?> 

	<?=
	$form->field($model, 'produto_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
		'id' => 'produto_fk',
		'data' => $produto,
		'size' => \kartik\select2\Select2::MEDIUM,
		'disabled' => (($model->id) ? true : false),
		'options' => [
			'placeholder' => '-- selecione --',
			//'multiple' => true,
		],
		'toggleAllSettings' => [
			'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Selecionar todos',
			'unselectLabel' => '<i class="glyphicon glyphicon-check"></i> Remover todos',
		],
		'pluginEvents' => [
		"change" => "function() { getProdutoPreco(this, '".  yii\helpers\Url::toRoute('get-preco-produto')."') }",
		],
		'pluginOptions' => [
			'allowClear' => true,
		],
	])
	?>

	<?=
	$form->field($model, 'cor_pano_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
		'data' => $cor,
		'size' => \kartik\select2\Select2::MEDIUM,
			'disabled' => (($model->id) ? true : false),
		'options' => [
			'placeholder' => '-- selecione --',
		//	'multiple' => true,
		],
		'toggleAllSettings' => [
			'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Selecionar todos',
			'unselectLabel' => '<i class="glyphicon glyphicon-check"></i> Remover todos',
		],
		'pluginEvents' => [
		"change" => "function() { verificaExite(this, '".  yii\helpers\Url::toRoute('verifica-exite')."') }",
		],
		'pluginOptions' => [
			'allowClear' => true,
		],
	])
	?>


	<?=
	$form->field($model, 'risco')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions' => [
			'thousands' => '.',
			'decimal' => ',',
			'precision' => 2,
			'allowZero' => false,]
	])
	?>

	<?=
	$form->field($model, 'pano')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions' => [
			'thousands' => '.',
			'decimal' => ',',
			'precision' => 2,
			'allowZero' => false,]
	])
	?>

	<?=
	$form->field($model, 'linha')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions' => [
			'thousands' => '.',
			'decimal' => ',',
			'precision' => 2,
			'allowZero' => false,]
	])
	?>

	<?=
	$form->field($model, 'bordado')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions' => [
			'thousands' => '.',
			'decimal' => ',',
			'precision' => 2,
			'allowZero' => false,]
	])
	?>

	<?=
	$form->field($model, 'costureira')->textInput()->widget(\kartik\money\MaskMoney::className(), [
		'pluginOptions' => [
			'thousands' => '.',
			'decimal' => ',',
			'precision' => 2,
			'allowZero' => false,]
	])
	?>

		<?=
		$form->field($model, 'enchimento')->textInput()->widget(\kartik\money\MaskMoney::className(), [
			'pluginOptions' => [
				'thousands' => '.',
				'decimal' => ',',
				'precision' => 2,
				'allowZero' => false,]
		])
		?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
