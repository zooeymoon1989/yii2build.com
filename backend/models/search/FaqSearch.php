<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Faq;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\db\Query;

/**
 * FaqSearch represents the model behind the search form about `backend\models\Faq`.
 */
class FaqSearch extends Faq
{

    public $faqCategoryName;
    public $faqCategoryList;
    public $faqIsFeatured;
    public $createdByUsername;
    public $updatedByUsername;
    public $faq_category;
    public $faq_weight;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faq_category_id', 'faq_is_featured', 'faq_weight', 'created_by', 'updated_by'], 'integer'],
            [['faq_question', 'faq_answer', 'created_at', 'updated_at',
                'faqCategoryName', 'faqCategoryList', 'faqIsFeaturedName',
                'createdByUsername', 'updatedByUsername', 'faq_category',
                'faq_weight'], 'safe'],
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
        $query = Faq::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort([
            'defaultOrder'=>[
                'faq_weight'=>SORT_ASC,
            ],
            'attributes'=>[
                'id',
                'faq_question'=>[
                    'asc'=>['faq.faq_question'=>SORT_ASC],
                    'desc' => ['faq.faq_question' => SORT_DESC],
                    'label' => 'Question'
                ],
                'faq_answer' => [
                    'asc' => ['faq.faq_answer' => SORT_ASC],
                    'desc' => ['faq.faq_answer' => SORT_DESC],
                    'label' => 'Answer'
                ],
                'faqCategoryName' => [
                    'asc' => ['faq_category.faq_category_name' => SORT_ASC],
                    'desc' => ['faq_category.faq_category_name' => SORT_DESC],
                    'label' => 'Category'
                ],
                'faq_weight' => [
                    'asc' => ['faq.faq_weight' => SORT_ASC],
                    'desc' => ['faq.faq_weight' => SORT_DESC],
                    'label' => 'Weight'
                ],
                'faqIsFeaturedName' => [
                    'asc' => ['faq.faq_is_featured' => SORT_ASC],
                    'desc' => ['faq.faq_is_featured' => SORT_DESC],
                    'label'=>'Featured?'
                ]
            ]
        ]);



        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['faqCategory']);

            return $dataProvider;
        }

        $this->addSearchParameter($query, 'id');
        $this->addSearchParameter($query, 'faq_category_id');
        $this->addSearchParameter($query, 'faq_weight');
        $this->addSearchParameter($query, 'faq_is_featured');
        $this->addSearchParameter($query, 'created_by');
        $this->addSearchParameter($query, 'updated_by');
        $this->addSearchParameter($query, 'faq_question', true);
        $this->addSearchParameter($query, 'faq_answer', true);

        $query->joinWith(['faqCategory'=>function($q){
            $q->andFilterWhere(['=','faq_category.faq_category_name',$this->faqCategoryName]);
        }]);

        return $dataProvider;
    }

    protected function addSearchParameter($query,$attribute,$partialMatch = false){
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }
        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }

        $attribute = "faq.$attribute";
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }


    /**
     * 去数据库中取得数据，并且将其转换成数组
     * @return ArrayDataProvider    得到的数据
     */
    public function frontendProvider()
    {
        $query = new Query;
        $provider = new ArrayDataProvider([
            'allModels'=>$query->from('faq')->all(),    //从哪个表中去数据
            'sort'=>[
                'defaultOrder'=>[   //默认排序
                    'faq_weight'=>SORT_ASC
                ],
                'attributes'=>['faq_question','faq_answer','faq_weight'],  
            ],

            'pagination'=>[ //设置分页
                'pageSize'=>10
            ]
        ]);

        return $provider;
    }

    public function featuredProvider()
    {

        $count = Yii::$app->db->createCommand('
            SELECT COUNT(*) FROM `faq` WHERE `faq_is_featured` = :faq_is_featured
        ',[':faq_is_featured'=>1])->queryScalar();

        $featuredProvider = new SqlDataProvider([
            'sql'=>'SELECT * FROM `faq` WHERE `faq_is_featured` = :faq_is_featured ORDER BY `faq_weight` ASC',
            'params'=>[':faq_is_featured'=>1],
            'totalCount'=>$count,
            'sort'=>[
                'attributes'=>[
                    'id',
                    'faq_question'
                ]
            ],
            'pagination'=>[
                'pageSize'=>10
            ]
        ]);

        return $featuredProvider;

    }
}
