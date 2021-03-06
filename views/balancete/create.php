<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Balancete */

$this->title = 'Create Balancete';
$this->params['breadcrumbs'][] = ['label' => 'Balancetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balancete-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        	'model' => $model,
				'modelAnt' => $modelAnt,
				'dataProviderSai' => $dataProviderSai,
				'dataProviderEnd' => $dataProviderEnd
    ]) ?>

</div>
