<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TerceirizadoItens;

/**
 * TerceirizadoItensSearch represents the model behind the search form about `app\models\TerceirizadoItens`.
 */
class TerceirizadoItensSearch extends TerceirizadoItens
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'produto_fk', 'classificacao_fk', 'quantidade', 'status', 'equipe', 'terceirizado_lote_fk'], 'integer'],
            [['data_inclusao', 'data_entrega', 'desenho'], 'safe'],
            [['valor'], 'number'],
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
        $query = TerceirizadoItens::find();

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
            'data_entrega' => $this->data_entrega,
            'valor' => $this->valor,
            'classificacao_fk' => $this->classificacao_fk,
            'quantidade' => $this->quantidade,
            'status' => $this->status,
            'equipe' => $this->equipe,
            'terceirizado_lote_fk' => $this->terceirizado_lote_fk,
        ]);

        $query->andFilterWhere(['like', 'desenho', $this->desenho]);

        return $dataProvider;
    }
}
