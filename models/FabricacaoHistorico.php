<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.fabricacao_historico".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $data_conclusao
 * @property string $pessoa
 * @property integer $qnt
 * @property integer $status
 * @property boolean $pago_status
 * @property string $fabricacao_fk
 *
 * @property Fabricacao $fabricacaoFk
 */
class FabricacaoHistorico extends \app\models\Models
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bcl.fabricacao_historico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inclusao', 'data_conclusao'], 'safe'],
            [['qnt', 'status', 'fabricacao_fk'], 'integer'],
            [['pago_status'], 'boolean'],
            [['pessoa'], 'string', 'max' => 80],
            [['fabricacao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Fabricacao::className(), 'targetAttribute' => ['fabricacao_fk' => 'id']],
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
            'data_conclusao' => 'Data Conclusao',
            'pessoa' => 'Pessoa',
            'qnt' => 'Qnt',
            'status' => 'Status',
            'pago_status' => 'Pago Status',
            'fabricacao_fk' => 'Fabricacao Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoFk()
    {
        return $this->hasOne(Fabricacao::className(), ['id' => 'fabricacao_fk']);
    }
}
