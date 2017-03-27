<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Movimentacao;

/**
 * MovimentacaoSearch represents the model behind the search form about `app\models\Movimentacao`.
 */
class MovimentacaoSearch extends Movimentacao
{
    /**
     * @inheritdoc
     */
	
	public $status_desc;
	public $entrada_saida_desc;
	public $valor_total;
	public $valor_comercial;
	        public $cliente;
    public function rules()
    {
        return [
            
            [['entrada_saida', 'tipo_pagamento', 'canal_venda'], 'required', 'on'=>'movimentacao'],
            [['id', 'cliente', 'cliente_fk', 'status', 'entrada_saida','data_entrega', 'data_inclusao', 'nome_feira','valor_frete', 'valor_pago', 'parcelas', 'parcela_atual', 'desconto', 'tipo_pagamento', 'canal_venda'], 'safe'],
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

	public function afterFind() {
		parent::afterFind();
		$this->status_desc = ($this->status==1) ? 'Pendente' : ( ($this->status==2) ? 'em andamento' : 'concluido');
		$this->entrada_saida_desc = ($this->entrada_saida_desc==1) ? 'Entrada' : 'Saída';
		$this->valor_total = ($this->valor_pago * $this->parcelas)-$this->desconto;
		//$this->data_entrega = MovimentacaoSearch::formataDataDoBanco($this->data_entrega);
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
        $query = MovimentacaoSearch::find();

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
            'cliente_fk' => $this->cliente_fk,
            'data_entrega' => $this->data_entrega,
            'data_inclusao' => $this->data_inclusao,
            'status' => $this->status,
            'valor_frete' => $this->valor_frete,
            'valor_pago' => $this->valor_pago,
            'parcelas' => $this->parcelas,
            'parcela_atual' => $this->parcela_atual,
            'desconto' => $this->desconto,
            'tipo_pagamento' => $this->tipo_pagamento,
            'entrada_saida' => $this->entrada_saida,
            'canal_venda' => $this->canal_venda,
        ]);

        $query->andFilterWhere(['like', 'nome_feira', $this->nome_feira]);
		$query->orderBy('data_entrega desc ', 'status');
        return $dataProvider;
    }
	
	public function beforeSave($insert) {
		$this->valor_total = Models::decimalFormatForBank($this->valor_total);
		$this->valor_frete = Models::decimalFormatForBank($this->valor_frete);
		$this->valor_pago = Models::decimalFormatForBank($this->valor_pago);
		$this->parcelas = Models::decimalFormatForBank($this->parcelas);

		$this->parcela_atual = Models::decimalFormatForBank($this->parcela_atual);
		$this->desconto = Models::decimalFormatForBank($this->desconto);
	
		
		return parent::beforeSave($insert);
	}
	
	
}
