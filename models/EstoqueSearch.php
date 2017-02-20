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
			[['id', 'produto_fk', 'classificacao_fk'], 'integer'],
			[['data_inclusao'], 'safe'],
			[['valor_custo', 'valor_unitario', 'qnt_diponivel', 'qnt_minimo', 'pano', 'bordado', 'costureira', 'linha', 'enchimento'], 'number'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function beforeSave($insert) {
		$this->valor_custo = Models::decimalFormatForBank($this->valor_custo);
		$this->valor_unitario = Models::decimalFormatForBank($this->valor_unitario);
		$this->pano = Models::decimalFormatForBank($this->pano);

		$this->bordado = Models::decimalFormatForBank($this->bordado);
		$this->costureira = Models::decimalFormatForBank($this->costureira);
		$this->linha = Models::decimalFormatForBank($this->linha);
		$this->enchimento = Models::decimalFormatForBank($this->enchimento);

		parent::beforeSave($insert);
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
			'produto_fk' => $this->produto_fk,
			'data_inclusao' => $this->data_inclusao,
			'valor_custo' => $this->valor_custo,
			'valor_unitario' => $this->valor_unitario,
			'qnt_diponivel' => $this->qnt_diponivel,
			'qnt_minimo' => $this->qnt_minimo,
			'pano' => $this->pano,
			'bordado' => $this->bordado,
			'costureira' => $this->costureira,
			'linha' => $this->linha,
			'enchimento' => $this->enchimento,
			'classificacao_fk' => $this->classificacao_fk,
		]);

		return $dataProvider;
	}

}
