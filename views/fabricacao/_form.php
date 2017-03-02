<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('@web/js/fabricacao.js', ['position' => $this::POS_END, 'depends' => [\app\assets\AppAsset::className()]]);
/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fabricacao-form">
    <?php $form = ActiveForm::begin(['id' => 'form-fabricacao']); ?>
   <?=$form->field($model, 'produto_comercial_fk')->hiddenInput()->label(false); ?>
    <div class="row">
        <div class="col-md-12">

            <?php
            
            if($model->isNewRecord){
            echo $form->field($model, 'produto_comercial')->textInput()->widget(yii\jui\AutoComplete::classname(), [
                'name' => 'produto_comercial',
                'options'=>['class'=>'form-control'],
                'clientOptions' => [
                    'source' => $produto,
                    'minLength' => '3',
                    'autoFill' => true,
                    'select' => new \yii\web\JsExpression("function( event, ui ) {
                    $('#fabricacaosearch-produto_comercial_fk').val(ui.item.id);}")
                ],
            ]);
                    
            }
            else{
                echo $form->field($model, 'produto_comercial')->textInput(['disabled'=>true]);
            }
            ?>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'qnt')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'status')->dropDownList($status) ?>
        </div>
    </div>
    <div id="divHistorico" style="display:<?php echo ($model->id) ? 'none' : 'block' ?>">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($modelHitorico, 'pessoa')->textInput(['maxlength' => true]) ?>
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
        <?= Html::submitButton($model->isNewRecord ? 'Incluir' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

</div>

<?php ActiveForm::end(); ?>
</div>