<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProdutoComercial */

$this->title = 'Create Produto Comercial';
$this->params['breadcrumbs'][] = ['label' => 'Produto Comercials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produto-comercial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', compact(['model', 'produto', 'classificacao','desenho', 'corPano', 'produto_preco', 'modelVis'])) ?>

</div>
