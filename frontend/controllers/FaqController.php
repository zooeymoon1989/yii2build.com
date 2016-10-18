<?php

namespace frontend\controllers;

use Yii;
use backend\models\Faq;
use backend\models\search\FaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $searchModel = new FaqSearch();
//        $provider = $searchModel->frontendProvider();
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'provider' => $provider,
//        ]);
        return $this->render('index');
    }

    /**
     * @param $id
     * @param null $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id,$slug =null)
    {

        $model = $this->findModel($id);

        if($slug == $model->slug){
            return $this->render('view',[
                'model'=>$model,
                'slug'=>$model->slug
            ]);
        }else{
            throw new NotFoundHttpException('The requested Faq does not exist.');
        }
    }


    /**
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
