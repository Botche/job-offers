<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;

use app\models\Category;

class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ], 
        ];
    }

    public function actionIndex()
    {
        $query = Category::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
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

        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/category');
        }

        $isModelSubmittedCorrectly = $category->load(Yii::$app->request->post()) && $category->validate();
        if ($isModelSubmittedCorrectly) {
            $category->save();
            Yii::$app->getSession()->setFlash('success', 'Category added successfully!');

            return $this->redirect('/category');
        }

        return $this->render('create', [
            'category' => $category,
        ]);
    }
}
