<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\VisFabricacao;

/**
 * CorPanoSearch represents the model behind the search form about `app\models\CorPano`.
 */

class VisFabricacaoSearch extends VisFabricacao
{

	public function attributeLabels() {
		return [
			'produto' => 'Produto',
			'cor' => 'Cor',
			'desenho' => 'Desenho',
			'classificacao' => 'Classificacao',
			'qnt' => 'Qnt',
			'status' => 'Status',
			'data_inclusao'=>'Inclusao'
		];
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = VisFabricacaoSearch::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
			'qnt' => $this->qnt,
			'status' => $this->status,
			

		]);

		$query->andFilterWhere(['like', 'produto', $this->produto]);
		$query->andFilterWhere(['like', 'produto_comercial', $this->produto_comercial]);
		$query->andFilterWhere(['like', 'data_inclusao', $this->data_inclusao]);
		$query->andFilterWhere(['like', 'cor_pano', $this->cor_pano]);
		 $query->andFilterWhere(['like', 'desenho', $this->desenho]);
		$query->andFilterWhere(['like', 'classificacao', $this->classificacao]);

		$query->orderBy('produto_comercial, data_inclusao desc');
		return $dataProvider;
	}

}
