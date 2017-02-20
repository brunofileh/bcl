<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TerceirizadoItens */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Terceirizado Itens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terceirizado-itens-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'produto_fk',
            'data_inclusao',
            'data_entrega',
            'valor',
            'classificacao_fk',
            'quantidade',
            'status',
            'equipe',
            'desenho',
            'terceirizado_lote_fk',
        ],
    ]) ?>

</div>
