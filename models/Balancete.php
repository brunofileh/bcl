<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.balancete".
 *
 * @property integer $id
 * @property string $entrada
 * @property string $saida
 * @property string $total
 * @property string $lucro
 * @property string $mes_ano
 */
class Balancete extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.balancete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entrada', 'saida', 'total', 'lucro'], 'number'],
            [['mes_ano'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entrada' => 'Entrada',
            'saida' => 'Saida',
            'total' => 'Total',
            'lucro' => 'Lucro',
            'mes_ano' => 'Mes Ano',
        ];
    }
}
