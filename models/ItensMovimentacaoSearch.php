<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItensMovimentacao;

/**
 * ItensMovimentacaoSearch represents the model behind the search form about `app\models\ItensMovimentacao`.
 */
class ItensMovimentacaoSearch extends ItensMovimentacao {

    /**
     * @inheritdoc
     */
    public $novo;
    public $qnt_estoque;
    public $descricao_produto;
    public $valor_total;

    public function rules() {
        return [
                [['movimentacao_fk', 'estoque_fk'], 'integer'],
                [['valor_unitario'], 'number'],
                [['novo', 'status', 'quantidade', 'qnt_estoque', 'descricao_produto', 'valor_total', 'valor_desconto'], 'safe'],
                ['quantidade', 'validaQuantidade'],
                [['estoque_fk', 'status', 'quantidade'], 'required']
        ];
    }

    public function validaQuantidade($attribute, $params) {
        if ($this->quantidade > $this->qnt_estoque) {
            $this->addError('quantidade', 'Quantidade não pode ser maior do que o estoque');
        }
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = ItensMovimentacao::find();

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
            'movimentacao_fk' => $this->movimentacao_fk,
            'estoque_fk' => $this->estoque_fk,
            'valor_desconto' => $this->valor_desconto,
            'valor_unitario' => $this->valor_unitario,
            'quantidade' => $this->quantidade,
        ]);

        $query->andFilterWhere(['like', 'desenho', $this->desenho]);

        return $dataProvider;
    }

    public static function buscaCampos($itens = []) {

        $itens = (\Yii::$app->session->get('itens')) ? \Yii::$app->session->get('itens') : ( ($itens) ? $itens : []);
        //print_r($itens); exit;
        $dataProvider = new \yii\data\ArrayDataProvider([
            'id' => 'movimentacao_itens',
            'allModels' => $itens,
            'sort' => false,
            'pagination' => ['pageSize' => 10],
        ]);


        return $dataProvider;
    }

}
