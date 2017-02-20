<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_pedidos".
 *
 * @property string $id
 * @property string $nome
 * @property string $data_entrega
 * @property integer $status
 * @property string $produto
 * @property string $classificacao
 * @property string $desenho
 * @property string $valor_desconto
 * @property string $valor_unitario
 * @property string $valor_liquido
 * @property integer $quantidade
 * @property string $valor_total
 * @property string $valor_lucro
 * @property string $valor_unitario_estoque
 * @property string $valor_custo_estoque
 * @property string $valor_lucro_estoque
 */
class VisPedidos extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.vis_pedidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'quantidade'], 'integer'],
            [['data_entrega'], 'safe'],
            [['classificacao', 'desenho'], 'string'],
            [['valor_desconto', 'valor_unitario', 'valor_liquido', 'valor_total', 'valor_lucro', 'valor_unitario_estoque', 'valor_custo_estoque', 'valor_lucro_estoque'], 'number'],
            [['nome', 'produto'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'data_entrega' => 'Data Entrega',
            'status' => 'Status',
            'produto' => 'Produto',
            'classificacao' => 'Classificacao',
            'desenho' => 'Desenho',
            'valor_desconto' => 'Valor Desconto',
            'valor_unitario' => 'Valor Unitario',
            'valor_liquido' => 'Valor Liquido',
            'quantidade' => 'Quantidade',
            'valor_total' => 'Valor Total',
            'valor_lucro' => 'Valor Lucro',
            'valor_unitario_estoque' => 'Valor Unitario Estoque',
            'valor_custo_estoque' => 'Valor Custo Estoque',
            'valor_lucro_estoque' => 'Valor Lucro Estoque',
        ];
    }
}
