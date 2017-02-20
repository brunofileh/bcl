<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoItens */

$this->title = 'Create Terceirizado Itens';
$this->params['breadcrumbs'][] = ['label' => 'Terceirizado Itens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceirizado-itens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
