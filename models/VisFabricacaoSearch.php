<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\VisFabricacao;

/**
 * CorPanoSearch represents the model behind the search form about `app\models\CorPano`.
 */
class VisFabricacaoSearch extends VisFabricacao {

	public function attributeLabels() {
		return [
			'produto' => 'Produto',
			'cor' => 'Cor',
			'desenho' => 'Desenho',
			'classificacao' => 'Classificacao',
			'qnt' => 'Qnt',
			'status' => 'Status',
			'cor_pano_fk' => 'Cor Pano Fk',
			'produto_preco_fk' => 'Produto Preco Fk',
			'id' => 'ID',
			'produto_fk' => 'Produto Fk',
			'desenho_fk' => 'Desenho Fk',
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
			'cor_pano_fk' => $this->cor_pano_fk,
			'produto_preco_fk' => $this->produto_preco_fk,
			'produto_fk' => $this->produto_fk,
			'desenho_fk' => $this->desenho_fk,
		]);

		$query->andFilterWhere(['like', 'produto', $this->produto]);
		$query->andFilterWhere(['like', 'cor', $this->cor]);
		$query->andFilterWhere(['like', 'desenho', $this->desenho]);
		$query->andFilterWhere(['like', 'classificacao', $this->classificacao]);


		return $dataProvider;
	}

}
