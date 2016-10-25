<?php
namespace api\controllers;

use \Yii;
use yii\rest\Controller;
use yii\filters\auth\QueryParamAuth;

abstract class BaseController extends Controller
{

    public function beforeAction($action)
    {
        return parent::beforeAction($action);
        \Yii::$app->user->enableSession = false;
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [QueryParamAuth::className()]);
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'create' => ['POST'],
        ];
    }

    public abstract function actionIndex();
    public abstract function actionCreate();
}