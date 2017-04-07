<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.vis_fabricacao".
 *
 * @property string $produto_comercial
 * @property string $produto
 * @property string $cor_pano
 * @property string $desenho
 * @property string $classificacao
 * @property integer $qnt
 * @property string $data_inclusao
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
            [['produto_comercial', 'classificacao', 'status_descricao'], 'string'],
            [['qnt', 'status', 'id'], 'integer'],
            [['data_inclusao'], 'safe'],
            [['produto', 'cor_pano', 'desenho'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'produto_comercial' => 'Produto Comercial',
            'produto' => 'Produto',
            'cor_pano' => 'Cor Pano',
            'desenho' => 'Desenho',
            'classificacao' => 'Classificacao',
            'qnt' => 'Qnt',
            'data_inclusao' => 'Data Inclusao',
            'status_descricao' => 'Status Descricao',
            'status' => 'Status',
            'id' => 'ID',
        ];
    }
}
