<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Profile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use common\models\RecordHelpers;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            //定义只有登录的用户才能访问这些action
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'only'=>['index','view','create','update','delete'],
                'allow'=>true,
                'roles'=>['@'],
                'matchCallback'=>function($rule,$action){
                    return PermissionHelpers::requireStatus('Active');
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        if($already_exists = RecordHelpers::userHas('profile')){    //如果用户有profile
            return $this->render('view',['model'=>$this->findModel($already_exists)]);
        }else{  //如果没有profile
            return $this->redirect(['create']);
        }
    }

    /**
     * Displays a single Profile model.
     * @return mixed
     */
    public function actionView()
    {
        if($already_exists = RecordHelpers::userHas('profile')){    //如果用户有profile
            return $this->render('view',['model'=>$this->findModel($already_exists)]);
        }else{  //如果没有profile
            return $this->redirect(['create']);
        }
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profile();

        $model->user_id = \Yii::$app->user->identity->getId();

        if($already_exists = RecordHelpers::userHas('profile')){    //如果已经存在profile

            return $this->render('view',['model'=>$this->findModel($already_exists)]);

        }elseif($model->load(Yii::$app->request->post()) && $model->save()) {   //创建成功

            return $this->redirect(['view']);

        }else{  //如果没有profile

            return $this->render('create', [
                'model' => $model,
            ]);

        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate()
    {

        PermissionHelpers::requireUpgradeTo('Paid');

        if($model = Profile::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one()){

            if($model->load(Yii::$app->request->post()) && $model->save()){

                return $this->render(['view']);

            }else{

                return $this->render('update',['model'=>$model]);

            }

        }else{

            throw new NotFoundHttpException('No such Profile');

        }

    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete()
    {
        $model = Profile::find()->where(['user_id'=>Yii::$app->user->identity->getId()])->one();

        $this->findModel($model->id)->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
