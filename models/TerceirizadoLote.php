<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.terceirizado_lote".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $data_lote_fechamento
 * @property string $quantidade
 * @property string $status
 * @property string $equipe
 *
 * @property TerceirizadoItens[] $terceirizadoItens
 */
class TerceirizadoLote extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.terceirizado_lote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao', 'data_lote_fechamento'], 'safe'],
            [['data_lote_fechamento'], 'required'],
            [['quantidade', 'status', 'equipe'], 'integer'],
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
            'data_lote_fechamento' => 'Data Lote Fechamento',
            'quantidade' => 'Quantidade',
            'status' => 'Status',
            'equipe' => 'Equipe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceirizadoItens()
    {
        return $this->hasMany(TerceirizadoItens::className(), ['terceirizado_lote_fk' => 'id']);
    }
}
