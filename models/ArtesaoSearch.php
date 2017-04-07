<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Artesao;

/**
 * ArtesaoSearch represents the model behind the search form about `app\models\Artesao`.
 */
class ArtesaoSearch extends Artesao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'uf'], 'safe'],
			[['nome', 'uf'], 'required'],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
		
		$atributes = parent::attributeLabels();
		$atributes['uf'] = 'UF';
        return $atributes;
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
        $query = ArtesaoSearch::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'uf', $this->uf]);

        return $dataProvider;
    }
	
	public function beforeSave($insert) {
		$this->uf = strtoupper($this->uf);
		return parent::beforeSave($insert);
	}
}
