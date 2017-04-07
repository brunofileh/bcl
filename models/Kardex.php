<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.kardex".
 *
 * @property string $id
 * @property integer $entrada_saida
 * @property string $itens_movimentacao_fk
 * @property string $valor
 * @property integer $qnt
 * @property string $data_inclusao
 * @property string $custo
 * @property string $saida_simples_fk
 * @property string $fabricacao_historico_fk
 *
 * @property FabricacaoHistorico $fabricacaoHistoricoFk
 * @property ItensMovimentacao $itensMovimentacaoFk
 * @property SaidaSimples $saidaSimplesFk
 */
class Kardex extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.kardex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entrada_saida'], 'required'],
            [['entrada_saida', 'itens_movimentacao_fk', 'qnt', 'saida_simples_fk', 'fabricacao_historico_fk'], 'integer'],
            [['valor', 'custo'], 'number'],
            [['data_inclusao'], 'safe'],
            [['fabricacao_historico_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FabricacaoHistorico::className(), 'targetAttribute' => ['fabricacao_historico_fk' => 'id']],
            [['itens_movimentacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ItensMovimentacao::className(), 'targetAttribute' => ['itens_movimentacao_fk' => 'id']],
            [['saida_simples_fk'], 'exist', 'skipOnError' => true, 'targetClass' => SaidaSimples::className(), 'targetAttribute' => ['saida_simples_fk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entrada_saida' => 'Entrada Saida',
            'itens_movimentacao_fk' => 'Itens Movimentacao Fk',
            'valor' => 'Valor',
            'qnt' => 'Qnt',
            'data_inclusao' => 'Data Inclusao',
            'custo' => 'Custo',
            'saida_simples_fk' => 'Saida Simples Fk',
            'fabricacao_historico_fk' => 'Fabricacao Historico Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoHistoricoFk()
    {
        return $this->hasOne(FabricacaoHistorico::className(), ['id' => 'fabricacao_historico_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItensMovimentacaoFk()
    {
        return $this->hasOne(ItensMovimentacao::className(), ['id' => 'itens_movimentacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaidaSimplesFk()
    {
        return $this->hasOne(SaidaSimples::className(), ['id' => 'saida_simples_fk']);
    }
}
