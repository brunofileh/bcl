<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Movimentacao */


$this->params['breadcrumbs'][] = ['label' => 'Movimentacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movimentacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
