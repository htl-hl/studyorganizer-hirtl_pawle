<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Aufgaben;

/**
 * AufgabenSearch represents the model behind the search form of `app\models\Aufgaben`.
 */
class AufgabenSearch extends Aufgaben
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Aufgaben_ID', 'Erledigt', 'L_ID', 'U_ID'], 'integer'],
            [['Titel', 'Beschreibung', 'Faelligkeitsdatum', 'F_Name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Aufgaben::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Aufgaben_ID' => $this->Aufgaben_ID,
            'Faelligkeitsdatum' => $this->Faelligkeitsdatum,
            'Erledigt' => $this->Erledigt,
            'L_ID' => $this->L_ID,
            'U_ID' => $this->U_ID,
        ]);

        $query->andFilterWhere(['like', 'Titel', $this->Titel])
            ->andFilterWhere(['like', 'Beschreibung', $this->Beschreibung])
            ->andFilterWhere(['like', 'F_Name', $this->F_Name]);

        return $dataProvider;
    }
}
