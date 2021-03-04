<?php

$this->title = $job->title;

$isOwner = Yii::$app->user->identity->id === $job->user_id;
$dateToTimeStamp = strtotime($job->created_at);
$formattedDate = date("j F, Y", $dateToTimeStamp);

?>

<div class="d-flex justify-content-between">
    <a href="/job" class="ml-0 my-4 btn btn-outline-primary">Back to list</a>
    <div>
        <?php if ($isOwner) : ?>
            <a href="/job/edit?id=<?= $job->id ?>" class="ml-0 my-4 btn btn-warning">Edit job</a>
            <button type="button" data-toggle="modal" data-target="#deleteModal" class="ml-0 my-4 btn btn-danger">Delete job</button>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="deleteModalLabel">
                    <b>Are you sure you want to delete <?= $job->title ?>?</b>
                </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/job/delete?id=<?= $job->id ?>" class="btn btn-danger">Delete it</a>
            </div>
        </div>
    </div>
</div>

<div class="row px-2">
    <div>
        <h1 class="inline"><?= $job->title; ?></h1>
        <small><?= $job->city; ?>, <?= $job->address; ?></small>
    </div>

    <div class="jumbotron mt-4 p-3 w-100">
        <p><b>Job Description: </b></p>
        <p><?= $job->description; ?></p>
    </div>

    <ul class="list-group w-100 mb-4">
        <li class="list-group-item">
            <b>Creation date: </b>
            <span><?= $formattedDate; ?></span>
        </li>
        <li class="list-group-item">
            <b>Category name: </b>
            <span><?= $job->category->name ?></span>
        </li>
        <li class="list-group-item">
            <b>Job type: </b>
            <span><?= ucwords(str_replace('_', ' ', $job->type)) ?></span>
        </li>
        <li class="list-group-item">
            <b>Requirements: </b>
            <span><?= $job->requirements ?></span>
        </li>
        <li class="list-group-item">
            <b>Salary range: </b>
            <span><?= $job->salary_range ?></span>
        </li>
        <li class="list-group-item">
            <b>Contact email: </b>
            <span><a href="mailto<?= $job->contact_email ?>"><?= $job->contact_email ?></a></span>
        </li>
        <li class="list-group-item">
            <b>Contact phone: </b>
            <span><a href="tel:<?= $job->contact_phone ?>"><?= $job->contact_phone ?></a></span>
        </li>
    </ul>

    <div class="w-100 mb-4">
        <a href="mailto:<?= $job->contact_email ?>" class="btn btn-outline-success w-100">Contact employeer</a>
    </div>
</div>
