<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.fabricacao".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $data_exclusao
 * @property integer $qnt
 * @property integer $status
 * @property string $produto_comercial_fk
 *
 * @property ProdutoComercial $produtoComercialFk
 * @property FabricacaoHistorico[] $fabricacaoHistoricos
 */
class Fabricacao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.fabricacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao', 'data_exclusao'], 'safe'],
            [['qnt', 'status', 'produto_comercial_fk'], 'integer'],
            [['produto_comercial_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProdutoComercial::className(), 'targetAttribute' => ['produto_comercial_fk' => 'id']],

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
            'qnt' => 'Qnt',
            'status' => 'Status',
            'produto_comercial_fk' => 'Produto Comercial Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getProdutoComercialFk()
    {
        return $this->hasOne(ProdutoComercial::className(), ['id' => 'produto_comercial_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

   public function getFabricacaoHistoricos()
    {
        return $this->hasMany(FabricacaoHistorico::className(), ['fabricacao_fk' => 'id']);
    }
}
