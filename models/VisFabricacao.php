<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_fabricacao".
 *
 * @property string $produto
 * @property string $cor_pano
 * @property string $desenho
 * @property string $classificacao
 * @property integer $qnt
 * @property string $status_descricao
 * @property integer $status
 * @property string $id
 */
class VisFabricacao extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.vis_fabricacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classificacao', 'status_descricao'], 'string'],
            [['qnt', 'status', 'id'], 'integer'],
            [['produto', 'cor_pano', 'desenho'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'produto' => 'Produto',
            'cor_pano' => 'Cor Pano',
            'desenho' => 'Desenho',
            'classificacao' => 'Classificacao',
            'qnt' => 'Qnt',
            'status_descricao' => 'Status Descricao',
            'status' => 'Status',
            'id' => 'ID',
        ];
    }
}
