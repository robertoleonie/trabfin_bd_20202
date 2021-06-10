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
        <li><?= $this->Html->link(__('List Tb Participants'), ['controller' => 'TbParticipants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Participant'), ['controller' => 'TbParticipants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb Hospital Units'), ['controller' => 'TbHospitalUnits', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Hospital Unit'), ['controller' => 'TbHospitalUnits', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb Questionnaires'), ['controller' => 'TbQuestionnaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Questionnaire'), ['controller' => 'TbQuestionnaires', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbAssessmentQuestionnaires view large-9 medium-8 columns content">
    <h3><?= h($tbAssessmentQuestionnaire->participant_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tb Participant') ?></th>
            <td><?= $tbAssessmentQuestionnaire->has('tb_participant') ? $this->Html->link($tbAssessmentQuestionnaire->tb_participant->participant_id, ['controller' => 'TbParticipants', 'action' => 'view', $tbAssessmentQuestionnaire->tb_participant->participant_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb Hospital Unit') ?></th>
            <td><?= $tbAssessmentQuestionnaire->has('tb_hospital_unit') ? $this->Html->link($tbAssessmentQuestionnaire->tb_hospital_unit->hospital_unit_id, ['controller' => 'TbHospitalUnits', 'action' => 'view', $tbAssessmentQuestionnaire->tb_hospital_unit->hospital_unit_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb Questionnaire') ?></th>
            <td><?= $tbAssessmentQuestionnaire->has('tb_questionnaire') ? $this->Html->link($tbAssessmentQuestionnaire->tb_questionnaire->questionnaire_id, ['controller' => 'TbQuestionnaires', 'action' => 'view', $tbAssessmentQuestionnaire->tb_questionnaire->questionnaire_id]) : '' ?></td>
        </tr>
    </table>
</div>
