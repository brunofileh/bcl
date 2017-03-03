<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.estoque".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $qnt_disponivel
 * @property string $produto_comercial_fk
 *
 * @property ProdutoComercial $produtoComercialFk
 */
class Estoque extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.estoque';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao'], 'safe'],
            [['qnt_disponivel'], 'number'],
            [['produto_comercial_fk'], 'integer'],
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
            'qnt_disponivel' => 'Qnt Disponivel',
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
}
