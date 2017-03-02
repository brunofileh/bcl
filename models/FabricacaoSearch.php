<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fabricacao;

/**
 * FabricacaoSearch represents the model behind the search form about `app\models\Fabricacao`.
 */
class FabricacaoSearch extends Fabricacao {

    public $produto_comercial;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['id', 'produto_comercial_fk', 'qnt', 'status'], 'integer'],
                [['data_inclusao', 'produto_comercial', 'data_exclusao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        $label = parent::attributeLabels();
        $label['qnt'] = 'Quantidade';
        return $label;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = FabricacaoSearch::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere([
            'id' => $this->id,
            'data_inclusao' => $this->data_inclusao,
            'produto_comercial_fk' => $this->produto_comercial_fk,
            'qnt' => $this->qnt,
            'status' => $this->status,
            //'data_exclusao' =>  (new \yii\db\Expression('Null')),
            
        ]);
        $query->andWhere(['data_exclusao' => null]);
        $query->orderBy('id');

        return $dataProvider;
    }

    /**
      /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoHistoricos() {
        return $this->hasMany(FabricacaoHistoricoSearch::className(), ['fabricacao_fk' => 'id']);
    }

}
