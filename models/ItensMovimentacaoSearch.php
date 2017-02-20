<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItensMovimentacao;

/**
 * ItensMovimentacaoSearch represents the model behind the search form about `app\models\ItensMovimentacao`.
 */
class ItensMovimentacaoSearch extends ItensMovimentacao
{
    /**
     * @inheritdoc
     */
	public $novo;
	
	public function rules()
    {
        return [
            [['movimentacao_fk', 'estoque_fk'], 'integer'],
            [['valor_desconto', 'valor_unitario'], 'number'],
            [['desenho', 'novo', 'status', 'quantidade'], 'safe'],
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

		$itens = (\Yii::$app->session->get('itens')) ? \Yii::$app->session->get('itens') : ($itens) ? $itens : [];
		
		$dataProvider = new \yii\data\ArrayDataProvider([
			'id' => 'movimentacao_itens',
			'allModels' => $itens,
			'sort' => false,
			'pagination' => ['pageSize' => 10],
		]);


		return $dataProvider;
	}
	
	public function beforeSave($insert) {
		$this->valor_desconto = Models::decimalFormatForBank($this->valor_desconto);
		$this->valor_unitario = Models::decimalFormatForBank($this->valor_unitario);
		$this->quantidade = Models::decimalFormatForBank($this->quantidade);
		
		return parent::beforeSave($insert);
	}
}
