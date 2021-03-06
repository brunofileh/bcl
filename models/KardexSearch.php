<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kardex;

/**
 * KardexSearch represents the model behind the search form about `app\models\Kardex`.
 */
class KardexSearch extends Kardex
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'entrada_saida', 'itens_movimentacao_fk'], 'integer'],
            [['valor', 'qnt'], 'number'],
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
        $query = Kardex::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'entrada_saida' => $this->entrada_saida,
            'itens_movimentacao_fk' => $this->itens_movimentacao_fk,
            'valor' => $this->valor,
            'qnt' => $this->qnt,
        ]);

        return $dataProvider;
    }
    
    
}
