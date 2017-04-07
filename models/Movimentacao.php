<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.movimentacao".
 *
 * @property string $id
 * @property string $cliente_fk
 * @property string $data_entrega
 * @property string $data_inclusao
 * @property integer $status
 * @property string $valor_frete
 * @property string $valor_pago
 * @property string $parcelas
 * @property string $parcela_atual
 * @property string $desconto
 * @property string $tipo_pagamento
 * @property integer $entrada_saida
 * @property string $canal_venda
 * @property string $nome_feira
 * @property integer $tipo_entrada
 * @property string $data_exclusao
 *
 * @property ItensMovimentacao[] $itensMovimentacaos
 * @property Cliente $clienteFk
 */
class Movimentacao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.movimentacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cliente_fk', 'status', 'entrada_saida', 'tipo_entrada'], 'integer'],
            [['data_entrega', 'data_inclusao', 'data_exclusao'], 'safe'],
            [['valor_frete', 'valor_pago', 'parcelas', 'parcela_atual', 'desconto', 'tipo_pagamento', 'canal_venda'], 'number'],
            [['nome_feira'], 'string', 'max' => 150],
            [['cliente_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_fk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cliente_fk' => 'Cliente Fk',
            'data_entrega' => 'Data Entrega',
            'data_inclusao' => 'Data Inclusao',
            'status' => 'Status',
            'valor_frete' => 'Valor Frete',
            'valor_pago' => 'Valor Pago',
            'parcelas' => 'Parcelas',
            'parcela_atual' => 'Parcela Atual',
            'desconto' => 'Desconto',
            'tipo_pagamento' => 'Tipo Pagamento',
            'entrada_saida' => 'Entrada Saida',
            'canal_venda' => 'Canal Venda',
            'nome_feira' => 'Nome Feira',
            'tipo_entrada' => 'Tipo Entrada',
            'data_exclusao' => 'Data Exclusao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItensMovimentacaos()
    {
        return $this->hasMany(ItensMovimentacao::className(), ['movimentacao_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteFk()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_fk']);
    }
}
