<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Balancete */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="balancete-form">


	<?=
	yii\grid\GridView::widget([
		'dataProvider' => $dataProviderEnd,
		'columns' => [
			'titulo',
			'mes_ano',
			'total',
			'lucro',
		],
	]);
	?>

	<?=
	yii\grid\GridView::widget([
		'dataProvider' => $dataProviderSai,
		'columns' => [
			'titulo',
			'mes_ano',
			'total',
			'lucro',
		],
	]);
	?>


	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'entrada')->textInput() ?>

	<?= $form->field($model, 'saida')->textInput() ?>

	<?= $form->field($model, 'total')->textInput() ?>

	<?= $form->field($model, 'lucro')->textInput() ?>

	<?= $form->field($model, 'mes_ano')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

	<?php ActiveForm::end(); ?>

</div>
