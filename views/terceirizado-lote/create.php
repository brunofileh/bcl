<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoLote */

$this->title = 'Create Terceirizado Lote';
$this->params['breadcrumbs'][] = ['label' => 'Terceirizado Lotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceirizado-lote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
