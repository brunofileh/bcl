<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItensMovimentacao */

$this->registerJsFile('@web/js/movimentacao.js', ['position' => $this::POS_END, 'depends' => [\app\assets\AppAsset::className()]]);
	
$this->title = 'Create Itens Movimentacao';
$this->params['breadcrumbs'][] = ['label' => 'Itens Movimentacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itens-movimentacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

      <div id="divGridItens" class='gride' style="display: block">
        <?= $this->render('_grid'); ?>
    </div>

    <?=
    Html::button('<i class="glyphicon glyphicon-plus"></i> Incluir Nova', [
        'class' => 'btn btn-success btn-sm',
        'id' => 'incluir-itens',
        'style' => 'display: block',
    ])
    ?>
    <?= $this->render('_form', ['form' => $form]); ?>

</div>
<br/>