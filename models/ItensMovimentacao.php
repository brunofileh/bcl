<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.itens_movimentacao".
 *
 * @property string $id
 * @property string $movimentacao_fk
 * @property string $estoque_fk
 * @property string $valor_desconto
 * @property string $valor_unitario
 * @property integer $quantidade
 * @property string $status
 *
 * @property Estoque2 $estoqueFk
 * @property Movimentacao $movimentacaoFk
 * @property Kardex[] $kardexes
 */
class ItensMovimentacao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.itens_movimentacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['movimentacao_fk', 'estoque_fk', 'valor_desconto', 'valor_unitario', 'quantidade'], 'required'],
            [['movimentacao_fk', 'estoque_fk', 'quantidade'], 'integer'],
            [['valor_desconto', 'valor_unitario', 'status'], 'number'],
            [['estoque_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Estoque2::className(), 'targetAttribute' => ['estoque_fk' => 'id']],
            [['movimentacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Movimentacao::className(), 'targetAttribute' => ['movimentacao_fk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'movimentacao_fk' => 'Movimentacao Fk',
            'estoque_fk' => 'Estoque Fk',
            'valor_desconto' => 'Valor Desconto',
            'valor_unitario' => 'Valor Unitario',
            'quantidade' => 'Quantidade',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstoqueFk()
    {
        return $this->hasOne(Estoque2::className(), ['id' => 'estoque_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimentacaoFk()
    {
        return $this->hasOne(Movimentacao::className(), ['id' => 'movimentacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKardexes()
    {
        return $this->hasMany(Kardex::className(), ['itens_movimentacao_fk' => 'id']);
    }
}
