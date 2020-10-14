<?php


namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class UsersController extends Controller
{
    public function actionUser($email, $username, $password)
    {
        $user = new User();
        $user->email = $email;
        $user->username = $username;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->save();
        var_dump('errors', $user->errors);
    }
}
