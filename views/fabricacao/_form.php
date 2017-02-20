<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$js = " 
	var urlDesenho = '" . \yii\helpers\Url::toRoute('incluir-desenho') . "';	
	var urlClassificacao = '" . \yii\helpers\Url::toRoute('incluir-classificacao') . "';	
";
$this->registerJs($js, $this::POS_BEGIN);

$this->registerJsFile('@web/js/fabricacao.js', ['position' => $this::POS_END, 'depends' => [\app\assets\AppAsset::className()]]);
/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fabricacao-form">
    <?php $form = ActiveForm::begin(['id' => 'form-fabricacao']); ?>
    <div class="row">
        <div class="col-md-12">

            <?=
            $form->field($model, 'produto_preco_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
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
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?>

        </div>

    </div>
    <div class="row">
        <div class="col-md-11">
            <?=
            $form->field($model, 'classificacao_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
                'id' => 'classificacao_fk',
                'data' => $classificacao,
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
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?></div>
        <div class="col-md-1">
            <?= Html::button(' + ', ['class' => 'btn btn-success', 'id' => 'incluir-classificacao']) ?>
        </div>
        <?php echo $this->render('/classificacao/_form_fabricacao', ['form' => $form]); ?>
    </div>
    <div class="row">

        <div class="col-md-11">
            <?=
            $form->field($model, 'desenho_fk')->textInput()->widget(\kartik\select2\Select2::className(), [
                'id' => 'desenho_fk',
                'data' => $desenho,
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
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
            ?> 
        </div>
        <div class="col-md-1">
            <?= Html::button(' + ', ['class' => 'btn btn-success', 'id' => 'incluir-desenho']) ?>
        </div>
        <?php echo $this->render('/desenho/_form_fabricacao', ['form' => $form]); ?>
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
                <?= $form->field($modelHitorico, 'data_conclusao')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'obs')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

</div>
</div>
<?php ActiveForm::end(); ?>
</div>