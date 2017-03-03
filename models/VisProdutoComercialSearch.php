<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\VisProdutoComercial;

/**
 * CorPanoSearch represents the model behind the search form about `app\models\CorPano`.
 */
class VisProdutoComercialSearch extends VisProdutoComercial {

	public function attributeLabels() {
		return [
			'produto' => 'Produto',
			'cor_pano' => 'Cor Pano',
			'desenho' => 'Desenho',
			'classificacao' => 'Classificacao',
			'risco' => 'Risco',
			'pano' => 'Pano',
			'linha' => 'Linha',
			'bordado' => 'Bordado',
			'costureira' => 'Costureira',
			'enchimento' => 'Enchimento',
			'id' => 'ID',
			'desenho_fk' => 'Desenho Fk',
			'classificacao_fk' => 'Classificacao Fk',
			'preco_fk' => 'Preco Fk',
			'produto_fk' => 'Produto Fk',
			'cor_pano_fk' => 'Cor Pano Fk',
		];
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params, $provider = true, $page = 0, $pagiSize = 5) {

		$query = VisProdutoComercialSearch::find();

		// add conditions that should always apply here
		if ($provider) {
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'pagination' => ['pageSize' => 5],
			]);
		}else{
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
				'pagination' => ['pageSize' => 5],
			]);
			
		}

		$this->load($params);

		// grid filtering conditions
		$query->andFilterWhere([
			'id' => $this->id,
			'cor_pano_fk' => $this->cor_pano_fk,
			'preco_fk' => $this->preco_fk,
			'produto_fk' => $this->produto_fk,
			'desenho_fk' => $this->desenho_fk,
			'classificacao_fk' => $this->classificacao_fk,
		]);

		$query->andFilterWhere(['like', 'produto', $this->produto]);
		$query->andFilterWhere(['like', 'cor_pano', $this->cor_pano]);
		$query->andFilterWhere(['like', 'desenho', $this->desenho]);
		$query->andFilterWhere(['like', 'classificacao', $this->classificacao]);


		return ($provider) ? $dataProvider : $query->all();
	}

	public function afterFind() {
		parent::afterFind();

		$this->pano = Models::decimalFormatToBank($this->pano);
		$this->bordado = Models::decimalFormatToBank($this->bordado);
		$this->costureira = Models::decimalFormatToBank($this->costureira);
		$this->linha = Models::decimalFormatToBank($this->linha);
		$this->enchimento = Models::decimalFormatToBank($this->enchimento);
		$this->risco = Models::decimalFormatToBank($this->risco);
		$this->valor_custo = Models::decimalFormatToBank($this->valor_custo);
	}

}
