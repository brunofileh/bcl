<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\VisEstoques;

/**
 * EstoqueSearch represents the model behind the search form about `app\models\Estoque`.
 */
class VisEstoquesSearch extends VisEstoques
{
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VisEstoques::find();

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
            'produto' => $this->produto,
            'valor_custo' => $this->valor_custo,
            'valor_unitario' => $this->valor_unitario,
            'qnt_diponivel' => $this->qnt_diponivel,
            'pano' => $this->pano,
            'bordado' => $this->bordado,
            'costureira' => $this->costureira,
            'linha' => $this->linha,
            'enchimento' => $this->enchimento,
            'descricao' => $this->descricao,
        ]);

        return $dataProvider;
    }
}
