<?php
namespace app\controllers;

use app\models\Operation;
use app\models\ReportSearch;
use app\models\OperationSearch;
use app\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;

class AdminController extends Controller
{
    public $layout = 'dashboard';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'matchCallback' => function($rule, $action) {
                            return \Yii::$app->user->isGuest || !\Yii::$app->user->getIdentity()->is_admin;
                        }
                    ],
                    [
                        'allow' => true
                    ]
                ],
            ]
        ];
    }


    public function actionIndex()
    {
        $searchModel  = new ReportSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('reports', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionOperations()
    {
        $searchModel  = new OperationSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('operations', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWithdrawals()
    {
        $model = new Operation(['is_for_user' => 0, 'user_id' => null]);
        if($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Operation has been done successfully.'));
            \Yii::$app->crmNotifier->newOperation($model);
            return $this->redirect(['admin/operations']);
        }
        else {
            return $this->render('cash-operation', [
                'model' => $model,
            ]);
        }
    }

    public function actionPersonWithdrawals()
    {
        $transaction =  \Yii::$app->db->beginTransaction();
        try {
            $model = new Operation(['is_for_user' => 1]);
            if($model->load(\Yii::$app->request->post()) && $model->save()) {

                \Yii::$app
                    ->db
                    ->createCommand("UPDATE users SET balance = balance + :balance WHERE id = :user_id", [
                        ':balance' => $model->is_debit ? $model->amount: -$model->amount,
                        ':user_id' => $model->user_id
                    ])
                    ->execute();

                $transaction->commit();
                \Yii::$app->crmNotifier->newOperation($model);
                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Operation has been done successfully.'));
                return $this->redirect(['admin/operations']);
            }
            else {
                return $this->render('person-operation', [
                    'model' => $model,
                    'users' => User::find()
                        ->select(['login', 'id'])
                        ->where(['is_admin' => 0])
                        ->orderBy('login')
                        ->indexBy('id')
                        ->asArray()
                        ->column()
                ]);
            }

        } catch(\Exception $e) {
            $transaction->rollBack();
            \Yii::$app->session->setFlash('danger', \Yii::t('app', $e->getMessage()));
            return $this->redirect(['admin/index']);
        }
    }
}