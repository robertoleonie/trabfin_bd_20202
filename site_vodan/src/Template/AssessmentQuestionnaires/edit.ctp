<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentQuestionnaire $assessmentQuestionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assessmentQuestionnaire->participant_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentQuestionnaire->participant_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assessment Questionnaires'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Participants'), ['controller' => 'Participants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participant'), ['controller' => 'Participants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['controller' => 'HospitalUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['controller' => 'HospitalUnits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentQuestionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($assessmentQuestionnaire) ?>
    <fieldset>
        <legend><?= __('Edit Assessment Questionnaire') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
