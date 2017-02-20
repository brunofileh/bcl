<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CorPano */

$this->title = 'Create Cor Pano';
$this->params['breadcrumbs'][] = ['label' => 'Cor Panos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cor-pano-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
