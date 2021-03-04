<?php

$this->title = 'Categories';

use yii\widgets\LinkPager;

?>
<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h1>Categories</h1>

    <?php if (yii::$app->user->isGuest === false) : ?>
        <a class="btn btn-primary" href="/category/create">Create category</a>
    <?php endif; ?>
</div>

<ul class="list-group">
    <?php foreach ($categories as $category) : ?>
        <li class="list-group-item">
            <a href="/job?categoryId=<?= $category->id; ?>"><?= $category->name; ?></a>
        </li>

    <?php endforeach; ?>
</ul>

<div class="mt-4">
    <?= LinkPager::widget(['pagination' => $pagination]); ?>
</div>
