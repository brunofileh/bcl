<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.produto_comercial".
 *
 * @property integer $id
 * @property string $desenho_fk
 * @property string $classificacao_fk
 * @property string $preco_fk
 * @property string $produto_fk
 * @property string $cor_pano_fk
 *
 * @property Estoque[] $estoques
 * @property Fabricacao[] $fabricacaos
 * @property Classificacao $classificacaoFk
 * @property CorPano $corPanoFk
 * @property Desenho $desenhoFk
 * @property Preco $precoFk
 * @property Produto $produtoFk
 */
class ProdutoComercial extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.produto_comercial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desenho_fk', 'classificacao_fk', 'preco_fk', 'produto_fk', 'cor_pano_fk'], 'integer'],
            [['desenho_fk', 'classificacao_fk', 'preco_fk', 'produto_fk', 'cor_pano_fk'], 'unique', 'targetAttribute' => ['desenho_fk', 'classificacao_fk', 'preco_fk', 'produto_fk', 'cor_pano_fk'], 'message' => 'The combination of Desenho Fk, Classificacao Fk, Preco Fk, Produto Fk and Cor Pano Fk has already been taken.'],
            [['classificacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classificacao::className(), 'targetAttribute' => ['classificacao_fk' => 'id']],
            [['cor_pano_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CorPano::className(), 'targetAttribute' => ['cor_pano_fk' => 'id']],
            [['desenho_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Desenho::className(), 'targetAttribute' => ['desenho_fk' => 'id']],
            [['preco_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Preco::className(), 'targetAttribute' => ['preco_fk' => 'id']],
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
            'desenho_fk' => 'Desenho Fk',
            'classificacao_fk' => 'Classificacao Fk',
            'preco_fk' => 'Preco Fk',
            'produto_fk' => 'Produto Fk',
            'cor_pano_fk' => 'Cor Pano Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstoques()
    {
        return $this->hasMany(Estoque::className(), ['produto_comercial_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaos()
    {
        return $this->hasMany(Fabricacao::className(), ['produto_comercial_fk' => 'id']);
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
    public function getDesenhoFk()
    {
        return $this->hasOne(Desenho::className(), ['id' => 'desenho_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecoFk()
    {
        return $this->hasOne(Preco::className(), ['id' => 'preco_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoFk()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_fk']);
    }
}
