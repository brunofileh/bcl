<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Desenho */

$this->title = 'Create Desenho';
$this->params['breadcrumbs'][] = ['label' => 'Desenhos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desenho-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
