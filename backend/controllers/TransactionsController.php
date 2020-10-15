<?php


namespace backend\controllers;


use common\models\User;
use common\services\UserTransactionsService;
use yii\web\Controller;

class TransactionsController extends Controller
{
    public function actionHistory()
    {
        $userId = \Yii::$app->user->id;

        $transactionsService = new UserTransactionsService($userId);
        $histories = $transactionsService->getHistory();

        if ($histories['success']) {
            return $this->render('history', ['histories' => $histories['data']]);
        } else {
            \Yii::$app->getSession()->setFlash('error', $histories['error']);
            return $this->redirect('history');
        }
    }

    public function actionExpense()
    {
        if (\Yii::$app->request->isPost) {
            $userId = \Yii::$app->user->id;
            $toUserId = \Yii::$app->request->post('toUserId');
            $sum = \Yii::$app->request->post('sum');

            $transactionsService = new UserTransactionsService($userId);
            $expenseResult = $transactionsService->expense((int)$toUserId, (int)$sum);

            if ($expenseResult['success']) {
                return $this->redirect('history');
            } else {
                \Yii::$app->getSession()->setFlash('error', $expenseResult['error']);
            }
        }

        $usersQuery = User::find()
            ->select(['id', 'username'])
            ->where(['<>', 'role', 'admin'])
            ->asArray()
            ->all();

        $users = [];
        foreach ($usersQuery as $user) {
            $users[$user['id']] = $user['username'];
        }

        return $this->render('expense', ['users' => $users]);
    }

    public function actionIncome()
    {
        if (\Yii::$app->request->isPost) {
            $userId = \Yii::$app->user->id;
            $toUserId = \Yii::$app->request->post('toUserId');
            $sum = \Yii::$app->request->post('sum');

            $transactionsService = new UserTransactionsService($userId);
            $incomeResult = $transactionsService->income((int)$toUserId, (int)$sum);

            if ($incomeResult['success']) {
                return $this->redirect('history');
            } else {
                \Yii::$app->getSession()->setFlash('error', $incomeResult['error']);
            }
        }

        $usersQuery = User::find()
            ->select(['id', 'username'])
            ->where(['<>', 'role', 'admin'])
            ->asArray()
            ->all();

        $users = [];
        foreach ($usersQuery as $user) {
            $users[$user['id']] = $user['username'];
        }

        return $this->render('income', ['users' => $users]);
    }
}
