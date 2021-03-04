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

        if ($user->load(Yii::$app->request->post())) {
            $user = User::findByUsername($user->username);
            yii::$app->user->login($user::findIdentity($user->id));
            Yii::$app->getSession()->setFlash('success', $user->username . ' logged successfully!');

            return $this->redirect('/');
        }

        $user->password = '';
        return $this->render('login', [
            'user' => $user,
        ]);
    }

    public function actionRegister()
    {
        $user = new User();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->validate()) {
                $user->save();
                Yii::$app->getSession()->setFlash('success', 'User registered successfully!');

                return $this->redirect('/');
            }
        }

        return $this->render('register', [
            'user' => $user,
        ]);
    }

    public function actionLogout()
    {
        yii::$app->user->logout();
        
        Yii::$app->getSession()->setFlash('success', 'Log out successfully!');

        return $this->redirect('/');
    }
}
