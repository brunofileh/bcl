<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.kit".
 *
 * @property string $id
 * @property string $produto_fk
 * @property string $produto_kit_fk
 *
 * @property Produto $produtoFk
 */
class Kit extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.kit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'produto_fk', 'produto_kit_fk'], 'required'],
            [['id', 'produto_fk', 'produto_kit_fk'], 'integer'],
            [['produto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_fk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produto_fk' => 'Produto Fk',
            'produto_kit_fk' => 'Produto Kit Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoFk()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_fk']);
    }
}
