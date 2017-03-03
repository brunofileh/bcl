<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Preco;

/**
 * PrecoSearch represents the model behind the search form about `app\models\Preco`.
 */
class PrecoSearch extends Preco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
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
	
	public function beforeSave($insert) {
		$this->pano = Models::decimalFormatForBank($this->pano);
		$this->bordado = Models::decimalFormatForBank($this->bordado);
		$this->costureira = Models::decimalFormatForBank($this->costureira);
		$this->linha = Models::decimalFormatForBank($this->linha);
		$this->enchimento = Models::decimalFormatForBank($this->enchimento);
		$this->risco = Models::decimalFormatForBank($this->risco);
		return parent::beforeSave($insert);
	}
	
	public function afterFind() {
		parent::afterFind();
		
		$this->pano = Models::decimalFormatToBank($this->pano);
		$this->bordado = Models::decimalFormatToBank($this->bordado);
		$this->costureira = Models::decimalFormatToBank($this->costureira);
		$this->linha = Models::decimalFormatToBank($this->linha);
		$this->enchimento = Models::decimalFormatToBank($this->enchimento);
		$this->risco = Models::decimalFormatToBank($this->risco);
		
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
        $query = Preco::find();

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
            'data_inclusao' => $this->data_inclusao,
            'risco' => $this->risco,
            'pano' => $this->pano,
            'linha' => $this->linha,
            'bordado' => $this->bordado,
            'costureira' => $this->costureira,
            'enchimento' => $this->enchimento,
        ]);

        return $dataProvider;
    }
}
