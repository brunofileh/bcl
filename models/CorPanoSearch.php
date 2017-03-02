<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CorPano;

/**
 * CorPanoSearch represents the model behind the search form about `app\models\CorPano`.
 */
class CorPanoSearch extends CorPano {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id'], 'integer'],
			[['descricao'], 'safe'],
			[['descricao'], 'unique', 'on'=>'produtoComercial'],
        	 [['descricao'], 'required', 'on'=>'produtoComercial'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function attributeLabels() {
		return [
			'id' => 'ID',
			'descricao' => 'Cor/Pano',
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
		$query = CorPano::find();

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
		]);

		$query->andFilterWhere(['like', 'descricao', $this->descricao]);

		return $dataProvider;
	}

}
