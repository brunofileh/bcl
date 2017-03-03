<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estoque */

$this->params['breadcrumbs'][] = ['label' => 'Estoques', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estoque-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'produto_comercial',
            'classificacao',
            'qnt_disponivel',
            'valor_custo',
            'valor_comercial',
            'valor_lucro',
            'valor_total_estoque',
            'valor_total_custo_estoque',
            'valor_total_lucro_estoque'
        ],
    ]) ?>
    
    <br />
    
    


</div>
