<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form about `app\models\Produto`.
 */
class ProdutoSearch extends Produto {

	public $unidade_desc;

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'unidade'], 'integer'],
			[['descricao', 'unidade_desc'], 'safe'],
		];
	}

	public function attributeLabels() {
		return [
			'id' => 'ID',
			'descricao' => 'Produto',
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
		$query = Produto::find();

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
			'unidade' => $this->unidade,
		]);

		$query->andFilterWhere(['like', 'descricao', $this->descricao]);

		$query->orderBy('descricao');

		return $dataProvider;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProdutoPrecos() {
		return $this->hasMany(ProdutoPrecoSearch::className(), ['produto_fk' => 'id']);
	}

}
