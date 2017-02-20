<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.estoques".
 *
 * @property string $id
 * @property string $produto
 * @property string $descricao
 * @property string $pano
 * @property string $bordado
 * @property string $linha
 * @property string $costureira
 * @property string $enchimento
 * @property string $qnt_diponivel
 * @property string $valor_custo
 * @property string $valor_unitario
 * @property string $valor_lucro
 */
class Estoques extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.estoques';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['descricao'], 'string'],
            [['pano', 'bordado', 'linha', 'costureira', 'enchimento', 'qnt_diponivel', 'valor_custo', 'valor_unitario', 'valor_lucro'], 'number'],
            [['produto'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produto' => 'Produto',
            'descricao' => 'Descricao',
            'pano' => 'Pano',
            'bordado' => 'Bordado',
            'linha' => 'Linha',
            'costureira' => 'Costureira',
            'enchimento' => 'Enchimento',
            'qnt_diponivel' => 'Qnt Diponivel',
            'valor_custo' => 'Valor Custo',
            'valor_unitario' => 'Valor Unitario',
            'valor_lucro' => 'Valor Lucro',
        ];
    }
}
