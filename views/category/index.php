<?php

use yii\widgets\LinkPager;

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <div class="d-flex align-items-center">
        <h1>Categories</h1>
        &nbsp;
        <small>Total count: <?= count($categories) ?></small>
    </div>

    <?php if (Yii::$app->user->isGuest === false) : ?>
        <a class="btn btn-primary" href="/category/create">Create category</a>
    <?php endif; ?>
</div>

<?php
$counter = 1;
if (empty($categories) === false) :
?>
    <ul class="list-group">
        <?php foreach ($categories as $category) : ?>
            <li class="list-group-item">
                <a href="/job?categoryId=<?= $category->id; ?>">
                    <span><?= $counter++; ?>.</span>
                    <?= $category->name; ?>
                </a>
            </li>

        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>There are no categories to list!</p>
<?php endif; ?>

<div class="mt-4">
    <?= LinkPager::widget(['pagination' => $pagination]); ?>
</div>
