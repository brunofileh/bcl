<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.cliente".
 *
 * @property string $id
 * @property string $nome
 * @property string $cnpj_cpf
 * @property string $telefone
 * @property string $celular
 * @property string $email
 * @property string $endereco
 * @property string $cep
 *
 * @property Movimentacao[] $movimentacaos
 */
class Cliente extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome', 'email'], 'string', 'max' => 200],
            [['cnpj_cpf'], 'string', 'max' => 18],
            [['telefone', 'celular'], 'string', 'max' => 14],
            [['endereco'], 'string', 'max' => 350],
            [['cep'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cnpj_cpf' => 'Cnpj Cpf',
            'telefone' => 'Telefone',
            'celular' => 'Celular',
            'email' => 'Email',
            'endereco' => 'Endereco',
            'cep' => 'Cep',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimentacaos()
    {
        return $this->hasMany(Movimentacao::className(), ['cliente_fk' => 'id']);
    }
}
