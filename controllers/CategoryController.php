<?php

namespace app\controllers;
namespace yii\web;

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
