<?php

use yii\widgets\LinkPager;

$this->title = 'Jobs';

?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-3">
    <h1>Jobs</h1>

    <?php if (Yii::$app->user->isGuest === false) : ?>
        <a class="btn btn-primary" href="/job/create">Create job</a>
    <?php endif; ?>
</div>

<?php if (empty($jobs) === false) : ?>
    <div class="row">
        <?php foreach ($jobs as $job) : ?>
            <?php
            $shortenDescription = strlen($job->description) < 100
                ? $job->description
                : strip_tags(substr($job->description, 0, 100) . '...');

            $dateToTimeStamp = strtotime($job->created_at);
            $formattedDate = date("j F, Y", $dateToTimeStamp);
            ?>

            <div class="card mb-3 mr-3 p-0 col-sm-6 col-md-4 <?= $job->is_published === 0 ? 'not-published' : '' ?>">
                <div class="card-header">
                    <?php if ($job->is_published === 0) : ?>
                        <svg class="icon not-published-icon">
                            <use xlink:href="/svgs/sprite.svg#visibility"></use>
                        </svg>
                    <?php endif; ?>

                    <h3><?= $job->title ?></h3>
                </div>
                <div class="card-body">
                    <p><b>Description: </b><?= $shortenDescription ?></p>
                    <p><b>City: </b><?= $job->city ?></p>
                    <p><b>Address: </b><?= $job->address ?></p>
                    <p><b>Listed on: </b><?= $formattedDate ?></p>
                </div>

                <div class="card-footer">
                    <a href="/job/details/<?= $job->id ?>" class="btn btn-info w-100">Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4">
        <?= LinkPager::widget(['pagination' => $pagination]); ?>
    </div>
<?php else : ?>
    <p>There are no jobs to list!</p>
<?php endif; ?>
