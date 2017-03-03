<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_estoque".
 *
 * @property string $produto_comercial
 * @property string $produto
 * @property string $cor_pano
 * @property string $desenho
 * @property string $classificacao
 * @property string $valor_custo
 * @property string $valor_comercial
 * @property string $id
 * @property string $data_inclusao
 * @property string $qnt_disponivel
 * @property string $valor_total_estoque
 * @property string $valor_total_custo_estoque
 */
class VisEstoque extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.vis_estoque';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produto_comercial', 'classificacao'], 'string'],
            [['valor_custo', 'valor_comercial', 'qnt_disponivel', 'valor_total_estoque', 'valor_total_custo_estoque'], 'number'],
            [['id'], 'integer'],
            [['data_inclusao'], 'safe'],
            [['produto', 'cor_pano', 'desenho'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'produto_comercial' => 'Produto Comercial',
            'produto' => 'Produto',
            'cor_pano' => 'Cor Pano',
            'desenho' => 'Desenho',
            'classificacao' => 'Classificacao',
            'valor_custo' => 'Valor Custo',
            'valor_comercial' => 'Valor Comercial',
            'id' => 'ID',
            'data_inclusao' => 'Data Inclusao',
            'qnt_disponivel' => 'Qnt Disponivel',
            'valor_total_estoque' => 'Valor Total Estoque',
            'valor_total_custo_estoque' => 'Valor Total Custo Estoque',
        ];
    }
}
