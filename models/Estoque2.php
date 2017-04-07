<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.estoque2".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $valor_custo
 * @property string $valor_unitario
 * @property string $qnt_diponivel
 * @property string $qnt_minimo
 * @property string $classificacao_fk
 * @property string $cor_pano_fk
 * @property string $produto_preco_fk
 *
 * @property Classificacao $classificacaoFk
 * @property CorPano $corPanoFk
 * @property Preco $produtoPrecoFk
 * @property ItensMovimentacao[] $itensMovimentacaos
 */
class Estoque2 extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.estoque2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao'], 'safe'],
            [['valor_custo', 'valor_unitario', 'qnt_diponivel', 'qnt_minimo'], 'number'],
            [['valor_unitario'], 'required'],
            [['classificacao_fk', 'cor_pano_fk', 'produto_preco_fk'], 'integer'],
            [['classificacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classificacao::className(), 'targetAttribute' => ['classificacao_fk' => 'id']],
            [['cor_pano_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CorPano::className(), 'targetAttribute' => ['cor_pano_fk' => 'id']],
            [['produto_preco_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Preco::className(), 'targetAttribute' => ['produto_preco_fk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_inclusao' => 'Data Inclusao',
            'valor_custo' => 'Valor Custo',
            'valor_unitario' => 'Valor Unitario',
            'qnt_diponivel' => 'Qnt Diponivel',
            'qnt_minimo' => 'Qnt Minimo',
            'classificacao_fk' => 'Classificacao Fk',
            'cor_pano_fk' => 'Cor Pano Fk',
            'produto_preco_fk' => 'Produto Preco Fk',
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
    public function getCorPanoFk()
    {
        return $this->hasOne(CorPano::className(), ['id' => 'cor_pano_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPrecoFk()
    {
        return $this->hasOne(Preco::className(), ['id' => 'produto_preco_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItensMovimentacaos()
    {
        return $this->hasMany(ItensMovimentacao::className(), ['estoque_fk' => 'id']);
    }
}
