<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.produto_preco".
 *
 * @property string $id
 * @property string $produto_fk
 * @property string $data_inclusao
 * @property string $risco
 * @property string $pano
 * @property string $linha
 * @property string $bordado
 * @property string $costureira
 * @property string $enchimento
 * @property string $cor_pano_fk
 *
 * @property Estoque[] $estoques
 * @property Fabricacao[] $fabricacaos
 * @property CorPano $corPanoFk
 * @property Produto $produtoFk
 */
class ProdutoPreco extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.produto_preco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produto_fk'], 'required'],
            [['produto_fk', 'cor_pano_fk'], 'integer'],
            [['data_inclusao'], 'safe'],
            [['risco', 'pano', 'linha', 'bordado', 'costureira', 'enchimento'], 'number'],
            [['cor_pano_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CorPano::className(), 'targetAttribute' => ['cor_pano_fk' => 'id']],
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
            'risco' => 'Risco',
            'pano' => 'Pano',
            'linha' => 'Linha',
            'bordado' => 'Bordado',
            'costureira' => 'Costureira',
            'enchimento' => 'Enchimento',
            'cor_pano_fk' => 'Cor Pano Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstoques()
    {
        return $this->hasMany(Estoque::className(), ['produto_preco_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaos()
    {
        return $this->hasMany(Fabricacao::className(), ['produto_preco_fk' => 'id']);
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
    public function getProdutoFk()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_fk']);
    }
}
