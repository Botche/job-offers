<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Category;
use app\models\Job;
use app\models\ContactForm;
use app\models\LoginForm;
use yii\data\Pagination;

class JobController extends Controller
{
    /**
     * Access controll
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'delete', 'edit', 'details'],
                'rules' => [
                    [
                        'actions' => ['create', 'delete', 'edit', 'details'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex($categoryId = null)
    {
        $query = Job::find()
            ->where(['is_published' => 1]);

        $isCategoryIdNull = $categoryId === null;
        if ($isCategoryIdNull === false) {
            $query->andWhere(['category_id' => $categoryId]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);

        $jobs = $query
            ->select('id, title, description, address, city, created_at')
            ->orderBy('created_at DESC')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'jobs' => $jobs,
            'pagination' => $pagination,
        ]);
    }

    public function actionDetails($id)
    {
        $job = Job::find()
            ->where([
                'job.id' => $id,
                'is_published' => 1,
            ])
            ->one();


        return $this->render('details', [
            'job' => $job,
        ]);
    }

    public function actionCreate()
    {
        $job = new Job();
        
        if (yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/');
        }

        if ($job->load(Yii::$app->request->post())) {
            if ($job->validate()) {
                $job->save();
                Yii::$app->getSession()->setFlash('success', 'Job added successfully!');

                return $this->redirect('/job');
            }
        }

        $categories = Category::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();

        return $this->render('create', [
            'job' => $job,
            'categories' => $categories,
        ]);
    }

    public function actionEdit($id)
    {
        $job = Job::findOne($id);

        $isOwner = yii::$app->user->identity->id === $job->user_id; 
        if ($isOwner === false) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/job');
        }

        if ($job->load(Yii::$app->request->post())) {
            if ($job->validate()) {
                $job->save();
                Yii::$app->getSession()->setFlash('success', 'Job updated successfully!');

                return $this->redirect('/job/details?id=' . $id);
            }
        }

        $categories = Category::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();

        return $this->render('edit', [
            'job' => $job,
            'categories' => $categories,
        ]);
    }

    public function actionDelete($id)
    {
        $job = Job::findOne($id);

        $isOwner = yii::$app->user->identity->id === $job->user_id; 
        if ($isOwner === false) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/job');
        }

        $job->delete();

        Yii::$app->getSession()->setFlash('success', 'Job deleted successfully!');

        return $this->redirect('/job');
    }
}
