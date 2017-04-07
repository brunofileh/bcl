<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bcl.fabricacao_historico".
 *
 * @property string $id
 * @property string $data_inclusao
 * @property string $data_conclusao
 * @property integer $qnt
 * @property integer $status
 * @property boolean $pago_status
 * @property string $fabricacao_fk
 * @property string $obs
 * @property string $artesao_fk
 *
 * @property Artesao $artesaoFk
 * @property Fabricacao $fabricacaoFk
 * @property Kardex[] $kardexes
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
            [['qnt', 'status', 'fabricacao_fk', 'artesao_fk'], 'integer'],
            [['pago_status'], 'boolean'],
            [['obs'], 'string', 'max' => 80],
            [['artesao_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Artesao::className(), 'targetAttribute' => ['artesao_fk' => 'id']],
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
            'qnt' => 'Qnt',
            'status' => 'Status',
            'pago_status' => 'Pago Status',
            'fabricacao_fk' => 'Fabricacao Fk',
            'obs' => 'Obs',
            'artesao_fk' => 'Artesao Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArtesaoFk()
    {
        return $this->hasOne(Artesao::className(), ['id' => 'artesao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoFk()
    {
        return $this->hasOne(Fabricacao::className(), ['id' => 'fabricacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKardexes()
    {
        return $this->hasMany(Kardex::className(), ['fabricacao_historico_fk' => 'id']);
    }
}
