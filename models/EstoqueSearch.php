<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Estoque;

/**
 * EstoqueSearch represents the model behind the search form about `app\models\Estoque`.
 */
class EstoqueSearch extends Estoque {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id'], 'integer'],
			[['data_inclusao'], 'safe'],
			[['qnt_diponivel'], 'number'],
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
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {
		$query = Estoque::find();

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
			'qnt_diponivel' => $this->qnt_diponivel,
			'produto_comercial_fk' => $this->produto_comercial_fk,
		]);

		return $dataProvider;
	}

}
