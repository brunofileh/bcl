<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FabricacaoHistorico;

/**
 * FabricacaoHistoricoSearch represents the model behind the search form about `app\models\FabricacaoHistorico`.
 */
class FabricacaoHistoricoSearch extends FabricacaoHistorico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'qnt', 'status', 'fabricacao_fk'], 'integer'],
            [['data_inclusao', 'data_conclusao', 'pessoa'], 'safe'],
            [['pago_status'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FabricacaoHistorico::find();

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
            'data_conclusao' => $this->data_conclusao,
            'qnt' => $this->qnt,
            'status' => $this->status,
            'pago_status' => $this->pago_status,
            'fabricacao_fk' => $this->fabricacao_fk,
        ]);

        $query->andFilterWhere(['like', 'pessoa', $this->pessoa]);

        return $dataProvider;
    }
	
	
	public static function buscaHistorico($item) {

		$itens = FabricacaoHistoricoSearch::find()->where(['fabricacao_fk'=>$item])->orderBy('id desc')->all();
		
		$dataProvider = new \yii\data\ArrayDataProvider([
			'id' => 'movimentacao_itens',
			'allModels' => $itens,
			'sort' => false,
			'pagination' => ['pageSize' => 10],
		]);


		return $dataProvider;
	}
}
