<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoLote */

$this->title = 'Update Terceirizado Lote: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Terceirizado Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="terceirizado-lote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
