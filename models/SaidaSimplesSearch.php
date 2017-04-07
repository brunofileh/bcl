<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaidaSimples;

/**
 * SaidaSimplesSearch represents the model behind the search form about `app\models\SaidaSimples`.
 */
class SaidaSimplesSearch extends SaidaSimples
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['descricao', 'data_inclusao', 'data_exclusao', 'data_saida'], 'safe'],
            [['valor'], 'number'],
            [['valor', 'descricao', 'data_saida', 'entrada_saida'], 'required'],
			
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
        $query = SaidaSimples::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

      
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'valor' => $this->valor,
            'data_inclusao' => $this->data_inclusao,
            'data_exclusao' => $this->data_exclusao,
        ]);
		$query->andWhere(['is', 'data_exclusao', null]);
        $query->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
