<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_produto_comercial".
 *
 * @property string $produto
 * @property string $cor_pano
 * @property string $desenho
 * @property string $classificacao
 * @property string $risco
 * @property string $pano
 * @property string $linha
 * @property string $bordado
 * @property string $costureira
 * @property string $enchimento
 * @property integer $id
 * @property string $desenho_fk
 * @property string $classificacao_fk
 * @property string $preco_fk
 * @property string $produto_fk
 * @property string $cor_pano_fk
 * @property string $valor_custo
 * @property string $valor_comercial
 * @property string $produto_comercial
 */
class VisProdutoComercial extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.vis_produto_comercial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classificacao', 'produto_comercial'], 'string'],
            [['risco', 'pano', 'linha', 'bordado', 'costureira', 'enchimento', 'valor_custo', 'valor_comercial'], 'number'],
            [['id', 'desenho_fk', 'classificacao_fk', 'preco_fk', 'produto_fk', 'cor_pano_fk'], 'integer'],
            [['produto', 'cor_pano', 'desenho'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'produto' => 'Produto',
            'cor_pano' => 'Cor Pano',
            'desenho' => 'Desenho',
            'classificacao' => 'Classificacao',
            'risco' => 'Risco',
            'pano' => 'Pano',
            'linha' => 'Linha',
            'bordado' => 'Bordado',
            'costureira' => 'Costureira',
            'enchimento' => 'Enchimento',
            'id' => 'ID',
            'desenho_fk' => 'Desenho Fk',
            'classificacao_fk' => 'Classificacao Fk',
            'preco_fk' => 'Preco Fk',
            'produto_fk' => 'Produto Fk',
            'cor_pano_fk' => 'Cor Pano Fk',
            'valor_custo' => 'Valor Custo',
            'valor_comercial' => 'Valor Comercial',
            'produto_comercial' => 'Produto Comercial',
        ];
    }
}
