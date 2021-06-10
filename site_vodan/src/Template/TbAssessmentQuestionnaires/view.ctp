<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbAssessmentQuestionnaire $tbAssessmentQuestionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Assessment Questionnaire'), ['action' => 'edit', $tbAssessmentQuestionnaire->participant_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Assessment Questionnaire'), ['action' => 'delete', $tbAssessmentQuestionnaire->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbAssessmentQuestionnaire->participant_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Assessment Questionnaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Assessment Questionnaire'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbAssessmentQuestionnaires view large-9 medium-8 columns content">
    <h3><?= h($tbAssessmentQuestionnaire->participant_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Participant Id') ?></th>
            <td><?= $this->Number->format($tbAssessmentQuestionnaire->participant_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hospital Unit Id') ?></th>
            <td><?= $this->Number->format($tbAssessmentQuestionnaire->hospital_unit_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire Id') ?></th>
            <td><?= $this->Number->format($tbAssessmentQuestionnaire->questionnaire_id) ?></td>
        </tr>
    </table>
</div>
