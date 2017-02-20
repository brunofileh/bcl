<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProdutoPreco;

/**
 * ProdutoPrecoSearch represents the model behind the search form about `app\models\ProdutoPreco`.
 */
class ProdutoPrecoSearch extends ProdutoPreco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'produto_fk', 'cor_pano_fk'], 'integer'],
            [['data_inclusao'], 'safe'],
            [['risco', 'pano', 'linha', 'bordado', 'costureira', 'enchimento'], 'number'],
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
        $query = ProdutoPreco::find();

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
            'risco' => $this->risco,
            'pano' => $this->pano,
            'linha' => $this->linha,
            'bordado' => $this->bordado,
            'costureira' => $this->costureira,
            'enchimento' => $this->enchimento,
            'cor_pano_fk' => $this->cor_pano_fk,
        ]);

        return $dataProvider;
    }
	
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoFk()
    {
        return $this->hasOne(ProdutoSearch::className(), ['id' => 'produto_fk']);
    }
}
