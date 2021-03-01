<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h1>Categories</h1>

    <a class="btn btn-primary" href="/category/create">Create category</a>
</div>

<?php
    $message = Yii::$app->getSession()->getFlash('success-message');
    $isNull = $message === null;
?>

<?php if ($isNull === false) : ?>
    <div class="alert alert-success">
    <?= $message; ?>
</div>
<?php endif; ?>

<ul class="list-group">
    <?php foreach ($categories as $category) : ?>
        <li class="list-group-item">
            <a href="/job?=categoryId=<?= $category->id; ?>"><?= $category->name; ?></a>
        </li>

    <?php endforeach; ?>
</ul>

<div class="mt-4">
    <?= LinkPager::widget(['pagination' => $pagination]); ?>
</div>
