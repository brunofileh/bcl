<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('@web/js/fabricacao.js', ['position' => $this::POS_END, 'depends' => [\app\assets\AppAsset::className()]]);
$artesao = yii\helpers\ArrayHelper::map(app\models\ArtesaoSearch::find()->select("id, nome")->orderBy('nome')->all(), 'id', 'nome');
/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fabricacao-form">
	<?php $form = ActiveForm::begin(['id' => 'form-fabricacao']); ?>
    <div class="row">
        <div class="col-md-12">
			<?= $form->field($model, 'status')->dropDownList($status) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
			<?= $form->field($model, 'qnt')->textInput() ?>
        </div>
    </div>
    <div id="divHistorico" style="display:<?php echo ($model->id) ? 'none' : 'block' ?>">
        <div class="row">
            <div class="col-md-12">
				<?= $form->field($modelHitorico, 'artesao_fk')->dropDownList($artesao, ['prompt' => 'Selecione']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<?= $form->field($modelHitorico, 'pago_status')->checkbox() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<?= $form->field($modelHitorico, 'obs')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	<?php ActiveForm::end(); ?>
</div>