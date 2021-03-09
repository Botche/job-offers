<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;

use app\models\Category;
use app\models\Job;

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
            ->where([
                'is_published' => 1,
                'is_deleted' => 0,
            ]);

        $currentUser = Yii::$app->user->identity;
        if (isset($currentUser)) {
            $query->orWhere([
                'user_id' => $currentUser->id,
                'is_published' => 0,
            ]);
        }

        if (isset($categoryId)) {
            $query->andWhere(['category_id' => $categoryId]);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);

        $jobs = $query
            ->select('id, title, description, address, city, created_at, is_published')
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
            ->select('id, title, category_id, type, user_id, requirements, salary_range, address, description, city, contact_email, contact_phone, is_published')
            ->where([
                'job.id' => $id,
                'is_deleted' => 0,
                'is_published' => 1,
            ])
            ->orWhere([
                'job.id' => $id,
                'is_deleted' => 0,
                'user_id' => Yii::$app->user->identity->id,
            ])
            ->one();

        if (isset($job) === false) {
            Yii::$app->getSession()->setFlash('danger', 'Such a job does not exists!');

            return $this->redirect('/job');
        }

        return $this->render('details', [
            'job' => $job,
            'isOwner' => Yii::$app->user->identity->id === $job->user_id,
        ]);
    }

    public function actionCreate()
    {
        $job = new Job();

        if (Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/');
        }

        $isModelSubmittedCorrectly = $job->load(Yii::$app->request->post()) && $job->validate();
        if ($isModelSubmittedCorrectly) {
            $job->save();
            Yii::$app->getSession()->setFlash('success', 'Job added successfully!');

            return $this->redirect('/job');
        }

        $categories = Category::find()
            ->select(['name', 'id'])
            ->indexBy('id')
            ->column();

        if (isset($categories) === false) {
            Yii::$app->getSession()->setFlash('warning', 'Must be atleast one category to create jobs');

            return $this->redirect('/category/create');
        }

        return $this->render('create', [
            'job' => $job,
            'categories' => $categories,
        ]);
    }

    public function actionEdit($id)
    {
        $job = Job::findOne($id);

        if (isset($job) === false) {
            Yii::$app->getSession()->setFlash('danger', 'Such a job does not exists!');

            return $this->redirect('/job');
        }

        $isOwner = Yii::$app->user->identity->id === $job->user_id;
        if ($isOwner === false) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/job');
        }

        $isModelSubmittedCorrectly = $job->load(Yii::$app->request->post()) && $job->validate();
        if ($isModelSubmittedCorrectly) {
            $job->save();
            Yii::$app->getSession()->setFlash('success', 'Job updated successfully!');

            return $this->redirect('/job/details?id=' . $id);
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

    public function actionPublish($id)
    {
        $job = Job::findOne($id);

        if (isset($job) === false) {
            Yii::$app->getSession()->setFlash('danger', 'Such a job does not exists!');

            return $this->redirect('/job');
        }

        $isOwner = Yii::$app->user->identity->id === $job->user_id;
        if ($isOwner === false) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/job');
        }

        $job->is_published = 1;
        $job->update();

        Yii::$app->getSession()->setFlash('success', 'Job published successfully!');

        return $this->redirect('/job');
    }

    public function actionUnpublish($id)
    {
        $job = Job::findOne($id);

        if (isset($job) === false) {
            Yii::$app->getSession()->setFlash('danger', 'Such a job does not exists!');

            return $this->redirect('/job');
        }

        $isOwner = Yii::$app->user->identity->id === $job->user_id;
        if ($isOwner === false) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/job');
        }

        $job->is_published = 0;
        $job->update();

        Yii::$app->getSession()->setFlash('info', 'Job unpublished.');

        return $this->redirect('/job');
    }

    public function actionDelete($id)
    {
        $job = Job::findOne($id);

        if (isset($job) === false) {
            Yii::$app->getSession()->setFlash('danger', 'Such a job does not exists!');

            return $this->redirect('/job');
        }

        $isOwner = Yii::$app->user->identity->id === $job->user_id;
        if ($isOwner === false) {
            Yii::$app->getSession()->setFlash('danger', 'You do not have rights to do this!');

            return $this->redirect('/job');
        }

        $job->is_deleted = 1;
        $job->deleted_at = date('Y-m-d');
        $job->update();

        Yii::$app->getSession()->setFlash('success', 'Job deleted successfully!');

        return $this->redirect('/job');
    }
}
