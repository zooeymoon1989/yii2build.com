<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{


    /**
     * attributes
     *
     * @var mixed
     */
    public $roleName;
    public $userTypeName;
    public $user_type_name;
    public $user_type_id;
    public $statusName;
    public $profileId;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_id', 'role_id', 'user_type_id'], 'integer'],
            [['username','roleName','statusName','userTypeName','profileId','user_type_name','email', 'created_at', 'updated_at'], 'safe'],
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
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params)
         * statement below
         */

        $dataProvider->setSort([
            'attributes'=>[
                'id',
                'userIdLink'=>[
                    'asc'=>['user.id'=>SORT_ASC],
                    'desc'=>['user.id'=>SORT_DESC],
                    'label'=>'User'
                ],
                'userLink'=>[
                    'asc'=>['user.username'=>SORT_ASC],
                    'desc'=>['user.username'=>SORT_DESC],
                    'label'=>'User'
                ],
                'profileLink'=>[
                    'asc'=>['profile.id'=>SORT_ASC],
                    'desc'=>['profile.id'=>SORT_DESC],
                    'label'=>'Profile'
                ],
                'roleName'=>[
                    'asc'=>['role.role_name'=>SORT_ASC],
                    'desc'=>['role.role_name'=>SORT_DESC],
                    'label'=>'Role'
                ],
                'statusName'=>[
                    'asc'=>['status.status_name'=>SORT_ASC],
                    'desc'=>['status.status_name'=>SORT_DESC],
                    'label'=>'Status'
                ],
                'userTypeName' => [
                    'asc' => ['user_type.user_type_name' => SORT_ASC],
                    'desc' => ['user_type.user_type_name' => SORT_DESC],
                    'label' => 'User Type'
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC],
                    'label' => 'Created At'
                ],
                'email' => [
                    'asc' => ['email' => SORT_ASC],
                    'desc' => ['email' => SORT_DESC],
                    'label' => 'Email'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');

            $query->joinWith(['role'])
                  ->joinWith(['status'])
                  ->joinWith(['profile'])
                  ->joinWith(['userType']);

            return $dataProvider;
        }


        // grid filtering conditions
        $this->addSearchParameter($query,'id');
        $this->addSearchParameter($query,'username',true);
        $this->addSearchParameter($query,'email',true);
        $this->addSearchParameter($query,'role_id');
        $this->addSearchParameter($query,'status_id');
        $this->addSearchParameter($query,'user_type_id');
        $this->addSearchParameter($query,'created_at');
        $this->addSearchParameter($query,'created_at');


        $query->joinWith(['role'=>function($q){
            $q->andFilterWhere(['=','role.role_name',$this->roleName]);
        }])->joinWith(['status'=>function($q){
            $q->andFilterWhere(['=','status.status_name',$this->statusName]);
        }])->joinWith(['profile'=>function($q){
            $q->andFilterWhere(['=','profile.id',$this->profileId]);
        }])->joinWith(['userType'=>function($q){
            $q->andFilterWhere(['=','user_type.user_type_name',$this->userTypeName]);
        }]);


        return $dataProvider;
    }


    /**
     * 重写了filterWhere方法
     *
     * @param $query object 查询对象
     * @param $attribute  string 查询属性
     * @param bool $partialMatch  是否强匹配
     */
    protected function addSearchParameter($query,$attribute,$partialMatch = false){

        if(($pos = strpos($attribute,'.'))!==false){    //如果属性中带有“.”字符
            $modelAttribute = substr($attribute,$pos+1);    //去点后面的字符串
        }else{
                $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;

        if(trim($value) ===''){
            return;
        }

        $attribute = "user.$attribute";

        if($partialMatch){
            $query->andWhere(['like',$attribute,$value]);
        }else{
            $query->andWhere([$attribute=>$value]);
        }
    }
}
