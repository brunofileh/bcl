<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.cor_pano".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Estoque2[] $estoque2s
 * @property ProdutoComercial[] $produtoComercials
 */
class CorPano extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.cor_pano';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstoque2s()
    {
        return $this->hasMany(Estoque2::className(), ['cor_pano_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoComercials()
    {
        return $this->hasMany(ProdutoComercial::className(), ['cor_pano_fk' => 'id']);
    }
}
