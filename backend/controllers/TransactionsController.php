<?php


namespace backend\controllers;


use common\services\UserTransactionsService;
use yii\web\Controller;

class TransactionsController extends Controller
{
    public function actionHistory()
    {
        $userId = \Yii::$app->user->id;

        $transactionsService = new UserTransactionsService($userId);
        $history = $transactionsService->getHistory();

        return $history;
    }

    public function actionExpense()
    {
        $userId = \Yii::$app->user->id;

        $transactionsService = new UserTransactionsService($userId);
        $expenseResult = $transactionsService->expanse();

        return $expenseResult;
    }

    public function actionIncome()
    {
        $userId = \Yii::$app->user->id;

        $transactionsService = new UserTransactionsService($userId);
        $incomeResult = $transactionsService->income();

        return $incomeResult;
    }
}
