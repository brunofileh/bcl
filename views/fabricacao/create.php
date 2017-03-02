<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fabricacao */


$this->params['breadcrumbs'][] = ['label' => 'Lista Produtos Fabricação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fabricacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'produto' => $produto,
        'status' => $status,
        'modelHitorico' => $modelHitorico,
    ])
    ?>

</div>
