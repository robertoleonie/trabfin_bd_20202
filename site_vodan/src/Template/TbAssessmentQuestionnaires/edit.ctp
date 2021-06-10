<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbAssessmentQuestionnaire $tbAssessmentQuestionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tbAssessmentQuestionnaire->participant_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tbAssessmentQuestionnaire->participant_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tb Assessment Questionnaires'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tb Participants'), ['controller' => 'TbParticipants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Participant'), ['controller' => 'TbParticipants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Hospital Units'), ['controller' => 'TbHospitalUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Hospital Unit'), ['controller' => 'TbHospitalUnits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Questionnaires'), ['controller' => 'TbQuestionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Questionnaire'), ['controller' => 'TbQuestionnaires', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbAssessmentQuestionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($tbAssessmentQuestionnaire) ?>
    <fieldset>
        <legend><?= __('Edit Tb Assessment Questionnaire') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
