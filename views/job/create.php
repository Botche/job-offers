<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Create job';
$this->params['breadcrumbs'][] = $this->title;

$jobTypes = [
    'full_time' => 'Full time',
    'part_time' => 'Part time',
    'as_needed' => 'As needed',
];

$salaries = [
    'Under $1000' => 'Under $1000',
    '$1000 - $2000' => '$1000 - $2000',
    '$2000 - $4000' => '$2000 - $4000',
    '$4000 - $6000' => '$4000 - $6000',
];

$promt = function ($text, $selected = true, $disabled = true) {
    return [
        'prompt' => [
            'text' => $text,
            'options' => [
                'disabled' => $selected,
                'selected' => $disabled
            ]
        ]
    ];
}

?>

<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-3">Add job</h1>
        <a href="/job" class="ml-0 my-4 btn btn-outline-primary">Back to list</a>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'job-form']); ?>

    <?= $form->field($job, 'category_id')->dropDownList($categories, $promt('Select Category')) ?>
    <?= $form->field($job, 'title') ?>
    <?= $form->field($job, 'description')->textarea(['rows' => 3]) ?>
    <?= $form->field($job, 'type')->dropDownList($jobTypes,  $promt('Select Type')) ?>
    <?= $form->field($job, 'requirements') ?>
    <?= $form->field($job, 'salary_range')->dropDownList($salaries, $promt('Select salary range')) ?>
    <?= $form->field($job, 'city') ?>
    <?= $form->field($job, 'address') ?>
    <?= $form->field($job, 'contact_email') ?>
    <?= $form->field($job, 'contact_phone') ?>
    <?= $form->field($job, 'is_published')->radioList(['1' => 'Yes', '0' => 'No']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
