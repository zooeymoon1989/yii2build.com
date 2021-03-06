<?php

namespace backend\controllers;

use Yii;
use backend\models\Faq;
use backend\models\search\FaqSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TestController extends Controller
{



    public function behaviors()
    {
        return [
            'verbs'=>[
                'class'=>VerbFilter::className(),
                'actions'=>[
                    'delete'=>['post']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        
        $query = Faq::find()->where(['faq_is_featured'=>1]);
        $query->orderBy(['faq_weight'=>SORT_ASC]);

        $countQuery = clone $query;
        $pages = new Pagination([
            'defaultPageSize'=>3,
            'totalCount'=>$countQuery->count()
        ]);;

        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index',[
            'models'=>$models,
            'pages'=>$pages
        ]);
    }

}
