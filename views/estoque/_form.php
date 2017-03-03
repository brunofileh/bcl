<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="estoque-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produto_comercial_fk')->hiddenInput()->label(false); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'produto_comercial')->textInput()->widget(yii\jui\AutoComplete::classname(), [
            'name' => 'produto_comercial',
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'source' => $produto,
                'minLength' => '3',
                'autoFill' => true,
                'select' => new \yii\web\JsExpression("function( event, ui ) {
                    $('#estoquesearch-produto_comercial_fk').val(ui.item.id);}")
            ],
        ]);
    } else {
        echo $form->field($model, 'produto_comercial')->textInput(['disabled' => true]);
    }
    ?>
    <?=
    $form->field($model, 'qnt_disponivel')->textInput()->widget(\kartik\money\MaskMoney::className(), [
        'pluginOptions' => [
            'thousands' => '.',
            'precision' => 0,
            'allowZero' => false,]
    ])
    ?>


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
