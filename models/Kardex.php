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
 * @property string $qnt
 *
 * @property ItensMovimentacao $itensMovimentacaoFk
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
            [['entrada_saida', 'valor'], 'required'],
            [['entrada_saida', 'itens_movimentacao_fk'], 'integer'],
            [['valor', 'qnt'], 'number'],
            [['itens_movimentacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ItensMovimentacao::className(), 'targetAttribute' => ['itens_movimentacao_fk' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItensMovimentacaoFk()
    {
        return $this->hasOne(ItensMovimentacao::className(), ['id' => 'itens_movimentacao_fk']);
    }
}
