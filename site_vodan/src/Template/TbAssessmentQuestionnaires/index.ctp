<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbAssessmentQuestionnaire[]|\Cake\Collection\CollectionInterface $tbAssessmentQuestionnaires
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Assessment Questionnaire'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Participants'), ['controller' => 'TbParticipants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Participant'), ['controller' => 'TbParticipants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Hospital Units'), ['controller' => 'TbHospitalUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Hospital Unit'), ['controller' => 'TbHospitalUnits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Questionnaires'), ['controller' => 'TbQuestionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Questionnaire'), ['controller' => 'TbQuestionnaires', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbAssessmentQuestionnaires index large-9 medium-8 columns content">
    <h3><?= __('Tb Assessment Questionnaires') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('participant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hospital_unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('questionnaire_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbAssessmentQuestionnaires as $tbAssessmentQuestionnaire): ?>
            <tr>
                <td><?= $tbAssessmentQuestionnaire->has('tb_participant') ? $this->Html->link($tbAssessmentQuestionnaire->tb_participant->participant_id, ['controller' => 'TbParticipants', 'action' => 'view', $tbAssessmentQuestionnaire->tb_participant->participant_id]) : '' ?></td>
                <td><?= $tbAssessmentQuestionnaire->has('tb_hospital_unit') ? $this->Html->link($tbAssessmentQuestionnaire->tb_hospital_unit->hospital_unit_id, ['controller' => 'TbHospitalUnits', 'action' => 'view', $tbAssessmentQuestionnaire->tb_hospital_unit->hospital_unit_id]) : '' ?></td>
                <td><?= $tbAssessmentQuestionnaire->has('tb_questionnaire') ? $this->Html->link($tbAssessmentQuestionnaire->tb_questionnaire->questionnaire_id, ['controller' => 'TbQuestionnaires', 'action' => 'view', $tbAssessmentQuestionnaire->tb_questionnaire->questionnaire_id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbAssessmentQuestionnaire->participant_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbAssessmentQuestionnaire->participant_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbAssessmentQuestionnaire->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbAssessmentQuestionnaire->participant_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
