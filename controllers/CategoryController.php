<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Category;
use app\models\ContactForm;
use app\models\LoginForm;
use yii\data\Pagination;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $query = Category::find();

        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);

        $categories = $query
            ->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'categories' => $categories,
            'pagination' => $pagination,
        ]);
    }

    public function actionCreate()
    {
        $category = new Category();

        if ($category->load(Yii::$app->request->post())) {
            if ($category->validate()) {
                $category->save();
                Yii::$app->getSession()->setFlash('success-message', 'Category added successfully!');

                return $this->redirect('/category');
            }
        }

        return $this->render('create', [
            'category' => $category,
        ]);
    }
}
