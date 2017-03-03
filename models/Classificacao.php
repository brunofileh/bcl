<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.classificacao".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $fk_classificacao
 *
 * @property Classificacao $fkClassificacao
 * @property Classificacao[] $classificacaos
 * @property Estoque2[] $estoque2s
 * @property ProdutoComercial[] $produtoComercials
 * @property TerceirizadoItens[] $terceirizadoItens
 */
class Classificacao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.classificacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string'],
            [['fk_classificacao'], 'integer'],
            [['fk_classificacao'], 'exist', 'skipOnError' => true, 'targetClass' => Classificacao::className(), 'targetAttribute' => ['fk_classificacao' => 'id']],
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
            'fk_classificacao' => 'Fk Classificacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkClassificacao()
    {
        return $this->hasOne(Classificacao::className(), ['id' => 'fk_classificacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassificacaos()
    {
        return $this->hasMany(Classificacao::className(), ['fk_classificacao' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstoque2s()
    {
        return $this->hasMany(Estoque2::className(), ['classificacao_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoComercials()
    {
        return $this->hasMany(ProdutoComercial::className(), ['classificacao_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceirizadoItens()
    {
        return $this->hasMany(TerceirizadoItens::className(), ['classificacao_fk' => 'id']);
    }
}
