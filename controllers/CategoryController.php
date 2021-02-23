<?php

namespace app\controllers;

use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
