<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FabricacaoHistorico */
/* @var $form yii\widgets\ActiveForm */

$artesao = yii\helpers\ArrayHelper::map(app\models\ArtesaoSearch::find()->select("id, nome")->orderBy('nome')->all(), 'id', 'nome');

?>
<div class="fabricacao-historico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data_conclusao')->textInput() ?>

   	<?= $form->field($model, 'artesao_fk')->dropDownList($artesao, ['prompt' => 'Selecione']) ?>

    <?= $form->field($model, 'qnt')->textInput() ?>

    <?= $form->field($model, 'pago_status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
