<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */

$this->params['breadcrumbs'][] = ['label' => 'Lista Produtos Fabricação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fabricacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'status' => $status,
        'modelHitorico' => $modelHitorico,
    ])
    ?>

</div>
