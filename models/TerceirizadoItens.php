<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.terceirizado_itens".
 *
 * @property string $id
 * @property string $produto_fk
 * @property string $data_inclusao
 * @property string $data_entrega
 * @property string $valor
 * @property string $classificacao_fk
 * @property string $quantidade
 * @property string $status
 * @property string $equipe
 * @property string $desenho
 * @property string $terceirizado_lote_fk
 *
 * @property Classificacao $classificacaoFk
 * @property Produto $produtoFk
 * @property TerceirizadoLote $terceirizadoLoteFk
 */
class TerceirizadoItens extends Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.terceirizado_itens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produto_fk', 'data_entrega'], 'required'],
            [['produto_fk', 'classificacao_fk', 'quantidade', 'status', 'equipe', 'terceirizado_lote_fk'], 'integer'],
            [['data_inclusao', 'data_entrega'], 'safe'],
            [['valor'], 'number'],
            [['desenho'], 'string', 'max' => 200],
            [['classificacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classificacao::className(), 'targetAttribute' => ['classificacao_fk' => 'id']],
            [['produto_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_fk' => 'id']],
            [['terceirizado_lote_fk'], 'exist', 'skipOnError' => true, 'targetClass' => TerceirizadoLote::className(), 'targetAttribute' => ['terceirizado_lote_fk' => 'id']],
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
            'data_inclusao' => 'Data Inclusao',
            'data_entrega' => 'Data Entrega',
            'valor' => 'Valor',
            'classificacao_fk' => 'Classificacao Fk',
            'quantidade' => 'Quantidade',
            'status' => 'Status',
            'equipe' => 'Equipe',
            'desenho' => 'Desenho',
            'terceirizado_lote_fk' => 'Terceirizado Lote Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassificacaoFk()
    {
        return $this->hasOne(Classificacao::className(), ['id' => 'classificacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoFk()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerceirizadoLoteFk()
    {
        return $this->hasOne(TerceirizadoLote::className(), ['id' => 'terceirizado_lote_fk']);
    }
}
