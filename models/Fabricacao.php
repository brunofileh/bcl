<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.fabricacao".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $classificacao_fk
 * @property string $produto_preco_fk
 * @property string $obs
 * @property integer $qnt
 * @property integer $status
 * @property string $desenho_fk
 *
 * @property Classificacao $classificacaoFk
 * @property Desenho $desenhoFk
 * @property ProdutoPreco $produtoPrecoFk
 * @property FabricacaoHistorico[] $fabricacaoHistoricos
 */
class Fabricacao extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.fabricacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao'], 'safe'],
            [['classificacao_fk', 'produto_preco_fk', 'qnt', 'status', 'desenho_fk'], 'integer'],
            [['obs'], 'string', 'max' => 80],
            [['classificacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classificacao::className(), 'targetAttribute' => ['classificacao_fk' => 'id']],
            [['desenho_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Desenho::className(), 'targetAttribute' => ['desenho_fk' => 'id']],
            [['produto_preco_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProdutoPreco::className(), 'targetAttribute' => ['produto_preco_fk' => 'id']],
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
            'classificacao_fk' => 'Classificacao Fk',
            'produto_preco_fk' => 'Produto Preco Fk',
            'obs' => 'Obs',
            'qnt' => 'Qnt',
            'status' => 'Status',
            'desenho_fk' => 'Desenho Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassificacaoFk()
    {
        return $this->hasOne(ClassificacaoSearch::className(), ['id' => 'classificacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesenhoFk()
    {
        return $this->hasOne(DesenhoSearch::className(), ['id' => 'desenho_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPrecoFk()
    {
        return $this->hasOne(ProdutoPrecoSearch::className(), ['id' => 'produto_preco_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoHistoricos()
    {
        return $this->hasMany(FabricacaoHistoricoSearch::className(), ['fabricacao_fk' => 'id']);
    }
}
