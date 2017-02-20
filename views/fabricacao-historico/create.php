<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FabricacaoHistorico */

$this->title = 'Create Fabricacao Historico';
$this->params['breadcrumbs'][] = ['label' => 'Fabricacao Historicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-historico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
