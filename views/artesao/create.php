<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Artesao */

$this->title = 'Create Artesao';
$this->params['breadcrumbs'][] = ['label' => 'Artesaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artesao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
