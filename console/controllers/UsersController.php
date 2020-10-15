<?php


namespace console\controllers;


use common\models\User;
use yii\console\Controller;

class UsersController extends Controller
{
    /**
     * @param $email
     * @param $username
     * @param $password
     * @param $role admin/user
     */
    public function actionUser($email, $username, $password, $role)
    {
        $user = new User();
        $user->email = $email;
        $user->username = $username;
        $user->status = User::STATUS_ACTIVE;
        $user->role = $role;
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->save();
        var_dump('errors', $user->errors);
    }
}
