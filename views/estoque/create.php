<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Estoque */

$this->title = 'Create Estoque';
$this->params['breadcrumbs'][] = ['label' => 'Estoques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estoque-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
