<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProdutoComercial */

$this->title = 'Update Produto Comercial: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Produto Comercials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="produto-comercial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', 
        compact(['model', 'produto', 'classificacao', 'desenho', 'corPano', 'produto_preco', 'modelVis'])
    ) ?>

</div>
