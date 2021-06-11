<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssessmentQuestionnaire[]|\Cake\Collection\CollectionInterface $assessmentQuestionnaires
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Assessment Questionnaire'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participants'), ['controller' => 'Participants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participant'), ['controller' => 'Participants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['controller' => 'HospitalUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['controller' => 'HospitalUnits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assessmentQuestionnaires index large-9 medium-8 columns content">
    <h3><?= __('Assessment Questionnaires') ?></h3>
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
            <?php foreach ($assessmentQuestionnaires as $assessmentQuestionnaire): ?>
            <tr>
                <td><?= $assessmentQuestionnaire->has('participant') ? $this->Html->link($assessmentQuestionnaire->participant->participant_id, ['controller' => 'Participants', 'action' => 'view', $assessmentQuestionnaire->participant->participant_id]) : '' ?></td>
                <td><?= $assessmentQuestionnaire->has('hospital_unit') ? $this->Html->link($assessmentQuestionnaire->hospital_unit->hospital_unit_id, ['controller' => 'HospitalUnits', 'action' => 'view', $assessmentQuestionnaire->hospital_unit->hospital_unit_id]) : '' ?></td>
                <td><?= $assessmentQuestionnaire->has('questionnaire') ? $this->Html->link($assessmentQuestionnaire->questionnaire->questionnaire_id, ['controller' => 'Questionnaires', 'action' => 'view', $assessmentQuestionnaire->questionnaire->questionnaire_id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assessmentQuestionnaire->participant_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assessmentQuestionnaire->participant_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assessmentQuestionnaire->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $assessmentQuestionnaire->participant_id)]) ?>
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
