<?php

namespace app\controllers;

namespace yii\web;

class UserController extends Controller
{
    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionRegister()
    {
        return $this->render('register');
    }
}
