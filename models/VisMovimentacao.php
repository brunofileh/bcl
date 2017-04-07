<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_movimentacao".
 *
 * @property string $id
 * @property string $nome
 * @property string $telefone
 * @property integer $status
 * @property string $status_descricao
 * @property string $valor_frete
 * @property string $valor_pago
 * @property string $parcelas
 * @property string $parcela_atual
 * @property string $tipo_pagamento
 * @property string $tipo_pagamento_descricao
 * @property integer $entrada_saida
 * @property string $canal_venda
 * @property string $nome_feira
 * @property string $qnt_produtos
 * @property string $valor_desconto
 * @property string $valor_total
 */
class VisMovimentacao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.vis_movimentacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'entrada_saida', 'qnt_produtos'], 'integer'],
            [['status_descricao', 'tipo_pagamento_descricao'], 'string'],
            [['valor_frete', 'valor_pago', 'parcelas', 'parcela_atual', 'tipo_pagamento', 'canal_venda', 'valor_desconto', 'valor_total'], 'number'],
            [['nome'], 'string', 'max' => 200],
            [['telefone'], 'string', 'max' => 14],
            [['nome_feira'], 'string', 'max' => 150],
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
            'telefone' => 'Telefone',
            'status' => 'Status',
            'status_descricao' => 'Status Descricao',
            'valor_frete' => 'Valor Frete',
            'valor_pago' => 'Valor Pago',
            'parcelas' => 'Parcelas',
            'parcela_atual' => 'Parcela Atual',
            'tipo_pagamento' => 'Tipo Pagamento',
            'tipo_pagamento_descricao' => 'Tipo Pagamento Descricao',
            'entrada_saida' => 'Entrada Saida',
            'canal_venda' => 'Canal Venda',
            'nome_feira' => 'Nome Feira',
            'qnt_produtos' => 'Qnt Produtos',
            'valor_desconto' => 'Valor Desconto',
            'valor_total' => 'Valor Total',
        ];
    }
}
