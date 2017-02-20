<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_produto".
 *
 * @property string $produto_fk
 * @property string $descricao
 * @property string $cor_pano_fk
 * @property string $produto_preco_fk
 */
class VisProduto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.vis_produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produto_fk', 'cor_pano_fk', 'produto_preco_fk'], 'integer'],
            [['descricao'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'produto_fk' => 'Produto Fk',
            'descricao' => 'Descricao',
            'cor_pano_fk' => 'Cor Pano Fk',
            'produto_preco_fk' => 'Produto Preco Fk',
        ];
    }
}
