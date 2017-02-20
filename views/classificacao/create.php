<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Classificacao */

$this->title = 'Create Classificacao';
$this->params['breadcrumbs'][] = ['label' => 'Classificacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classificacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
