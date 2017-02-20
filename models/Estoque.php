<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.estoque".
 *
 * @property string $id
 * @property string $produto_fk
 * @property string $data_inclusao
 * @property string $valor_custo
 * @property string $valor_unitario
 * @property string $qnt_diponivel
 * @property string $qnt_minimo
 * @property string $pano
 * @property string $bordado
 * @property string $costureira
 * @property string $linha
 * @property string $enchimento
 * @property string $classificacao_fk
 *
 * @property Classificacao $classificacaoFk
 * @property Produto $produtoFk
 * @property ItensMovimentacao[] $itensMovimentacaos
 */
class Estoque extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.estoque';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produto_fk', 'valor_unitario'], 'required'],
            [['produto_fk', 'classificacao_fk'], 'integer'],
            [['data_inclusao'], 'safe'],
            [['valor_custo', 'valor_unitario', 'qnt_diponivel', 'qnt_minimo', 'pano', 'bordado', 'costureira', 'linha', 'enchimento'], 'number'],
            [['classificacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classificacao::className(), 'targetAttribute' => ['classificacao_fk' => 'id']],
            [['produto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_fk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produto_fk' => 'Produto Fk',
            'data_inclusao' => 'Data Inclusao',
            'valor_custo' => 'Valor Custo',
            'valor_unitario' => 'Valor Unitario',
            'qnt_diponivel' => 'Qnt Diponivel',
            'qnt_minimo' => 'Qnt Minimo',
            'pano' => 'Pano',
            'bordado' => 'Bordado',
            'costureira' => 'Costureira',
            'linha' => 'Linha',
            'enchimento' => 'Enchimento',
            'classificacao_fk' => 'Classificacao Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassificacaoFk()
    {
        return $this->hasOne(Classificacao::className(), ['id' => 'classificacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoFk()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItensMovimentacaos()
    {
        return $this->hasMany(ItensMovimentacao::className(), ['estoque_fk' => 'id']);
    }
}
