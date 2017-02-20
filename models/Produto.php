<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.produto".
 *
 * @property string $id
 * @property string $descricao
 * @property integer $unidade
 *
 * @property Kit[] $kits
 * @property ProdutoPreco[] $produtoPrecos
 * @property TerceirizadoItens[] $terceirizadoItens
 */
class Produto extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'unidade'], 'required'],
            [['unidade'], 'integer'],
            [['descricao'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'unidade' => 'Unidade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKits()
    {
        return $this->hasMany(Kit::className(), ['produto_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPrecos()
    {
        return $this->hasMany(ProdutoPreco::className(), ['produto_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceirizadoItens()
    {
        return $this->hasMany(TerceirizadoItens::className(), ['produto_fk' => 'id']);
    }
}
