<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.saida_simples".
 *
 * @property integer $id
 * @property string $descricao
 * @property string $valor
 * @property string $data_inclusao
 * @property string $data_exclusao
 * @property string $data_saida
 * @property integer $entrada_saida
 *
 * @property Kardex[] $kardexes
 */
class SaidaSimples extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.saida_simples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor'], 'number'],
            [['data_inclusao', 'data_exclusao', 'data_saida'], 'safe'],
            [['entrada_saida'], 'integer'],
            [['descricao'], 'string', 'max' => 300],
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
            'valor' => 'Valor',
            'data_inclusao' => 'Data Inclusao',
            'data_exclusao' => 'Data Exclusao',
            'data_saida' => 'Data Saida',
            'entrada_saida' => 'Entrada Saida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKardexes()
    {
        return $this->hasMany(Kardex::className(), ['saida_simples_fk' => 'id']);
    }
}
