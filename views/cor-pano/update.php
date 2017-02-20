<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CorPano */

$this->title = 'Update Cor Pano: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cor Panos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cor-pano-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
