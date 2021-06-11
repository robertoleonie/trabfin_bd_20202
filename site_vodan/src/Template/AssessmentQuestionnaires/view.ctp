<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentQuestionnaire $assessmentQuestionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Assessment Questionnaire'), ['action' => 'edit', $assessmentQuestionnaire->participant_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Assessment Questionnaire'), ['action' => 'delete', $assessmentQuestionnaire->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentQuestionnaire->participant_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assessment Questionnaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assessment Questionnaire'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Participants'), ['controller' => 'Participants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participant'), ['controller' => 'Participants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['controller' => 'HospitalUnits', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['controller' => 'HospitalUnits', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assessmentQuestionnaires view large-9 medium-8 columns content">
    <h3><?= h($assessmentQuestionnaire->participant_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Participant') ?></th>
            <td><?= $assessmentQuestionnaire->has('participant') ? $this->Html->link($assessmentQuestionnaire->participant->participant_id, ['controller' => 'Participants', 'action' => 'view', $assessmentQuestionnaire->participant->participant_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hospital Unit') ?></th>
            <td><?= $assessmentQuestionnaire->has('hospital_unit') ? $this->Html->link($assessmentQuestionnaire->hospital_unit->hospital_unit_id, ['controller' => 'HospitalUnits', 'action' => 'view', $assessmentQuestionnaire->hospital_unit->hospital_unit_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire') ?></th>
            <td><?= $assessmentQuestionnaire->has('questionnaire') ? $this->Html->link($assessmentQuestionnaire->questionnaire->questionnaire_id, ['controller' => 'Questionnaires', 'action' => 'view', $assessmentQuestionnaire->questionnaire->questionnaire_id]) : '' ?></td>
        </tr>
    </table>
</div>
