<?php

namespace app\controllers;

use Yii;
use \yii\web\Controller;

use app\models\User;

class UserController extends Controller
{
    public function actionLogin()
    {
        $user = new User();

        $isPostRequest = $user->load(Yii::$app->request->post());
        if ($isPostRequest) {
            $enteredPassword = $user->password;
            $user = User::findByUsername($user->username);
            
            $isNull = $user === null;
            if ($isNull) {
                $user = new User();
            }

            $areCredentialsTrue = $user->validatePassword($enteredPassword)
                && Yii::$app->user->login($user);
            if ($areCredentialsTrue) {
                Yii::$app->getSession()->setFlash('success', $user->username . ' logged successfully!');

                return $this->redirect('/');
            }

            $user->password = '';
            Yii::$app->getSession()->setFlash('danger', 'Credentials are not correct!');
        }

        return $this->render('login', [
            'user' => $user,
        ]);
    }

    public function actionRegister()
    {
        $user = new User();

        $isModelSubmittedCorrectly = $user->load(Yii::$app->request->post()) && $user->validate();
        if ($isModelSubmittedCorrectly) {
            $user->save();
            Yii::$app->getSession()->setFlash('success', 'User registered successfully!');

            return $this->redirect('/');
        }

        return $this->render('register', [
            'user' => $user,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        Yii::$app->getSession()->setFlash('success', 'Log out successfully!');

        return $this->redirect('/');
    }
}
