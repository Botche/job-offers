<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<h1>Categories</h1>

<ul class="list-group">
<?php foreach ($categories as $category) : ?>
    <li class="list-group-item">
        <a href="/job?=categoryId=<?= $category->id; ?>"><?= $category->name; ?></a>
    </li>

<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]); ?>