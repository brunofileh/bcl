<?php

namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\VisEstoque;

/**
 * EstoqueSearch represents the model behind the search form about `app\models\Estoque`.
 */
class VisEstoqueSearch extends VisEstoque
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
        $query = VisEstoqueSearch::find();

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
            'produto_comercial' => $this->produto_comercial,
            'produto' => $this->produto,
            'cor_pano' => $this->cor_pano,
            'desenho' => $this->desenho,
            'classificacao' => $this->valor_comercial,
            'valor_custo' => $this->valor_comercial,
            'valor_comercial' => $this->valor_comercial,
            'data_inclusao' => $this->data_inclusao,
            'qnt_disponivel' => $this->qnt_disponivel,
            'valor_total_estoque' => $this->valor_total_estoque,
            'valor_total_custo_estoque' => $this->valor_total_custo_estoque,
        ]);

        return $dataProvider;
    }
}
