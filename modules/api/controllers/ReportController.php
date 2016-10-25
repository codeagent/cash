<?php
namespace api\controllers;

use \Yii;
use app\models\Report;
use app\models\ReportSearch;
use yii\web\ForbiddenHttpException;


class ReportController extends BaseController
{
    /**
     * curl -i -H "Accept:application/json" "http://localhost:8080/api/reports?access-token=admin"
     * curl -i -H "Accept:application/json" "http://localhost:8080/api/reports?access-token=Bernard+Lindgren"
     */
    public function actionIndex()
    {
        $model = new ReportSearch();
        $dataProvider = $model->search(Yii::$app->getRequest()->get());

        if(!\Yii::$app->user->getIdentity()->is_admin) {
            $dataProvider
                ->query
                ->andWhere(['user_id' => \Yii::$app->user->getIdentity()->id]);
        }
        return $dataProvider;
    }

    /**
     * curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/reports?access-token=admin" -d '{"user_id": 1, "amount": 50000.00, "article":1}'
     * curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/reports?access-token=Bernard+Lindgren" -d '{"user_id": 1, "amount": 50000.00, "article":1}'
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->getIdentity()->is_admin) {
            throw new ForbiddenHttpException();
        }
        $model = new Report();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if($model->save()) {
            Yii::$app->response->setStatusCode(201);
        }
        return $model;
    }
}