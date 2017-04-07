<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.preco".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $risco
 * @property string $pano
 * @property string $linha
 * @property string $bordado
 * @property string $costureira
 * @property string $enchimento
 * @property string $valor_comercial
 *
 * @property Estoque2[] $estoque2s
 * @property ProdutoComercial[] $produtoComercials
 */
class Preco extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.preco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao'], 'safe'],
            [['risco', 'pano', 'linha', 'bordado', 'costureira', 'enchimento', 'valor_comercial'], 'number'],
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
            'risco' => 'Risco',
            'pano' => 'Pano',
            'linha' => 'Linha',
            'bordado' => 'Bordado',
            'costureira' => 'Costureira',
            'enchimento' => 'Enchimento',
            'valor_comercial' => 'Valor Comercial',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstoque2s()
    {
        return $this->hasMany(Estoque2::className(), ['produto_preco_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoComercials()
    {
        return $this->hasMany(ProdutoComercial::className(), ['preco_fk' => 'id']);
    }
}
