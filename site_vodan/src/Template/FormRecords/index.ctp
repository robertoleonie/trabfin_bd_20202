<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormRecord[]|\Cake\Collection\CollectionInterface $formRecords
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Form Record'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Participants'), ['controller' => 'Participants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participant'), ['controller' => 'Participants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['controller' => 'HospitalUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['controller' => 'HospitalUnits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formRecords index large-9 medium-8 columns content">
    <h3><?= __('Form Records') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('form_record_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('participant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hospital_unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('questionnaire_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dtRegistroForm') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formRecords as $formRecord): ?>
            <tr>
                <td><?= $this->Number->format($formRecord->form_record_id) ?></td>
                <td><?= $formRecord->has('participant') ? $this->Html->link($formRecord->participant->participant_id, ['controller' => 'Participants', 'action' => 'view', $formRecord->participant->participant_id]) : '' ?></td>
                <td><?= $formRecord->has('hospital_unit') ? $this->Html->link($formRecord->hospital_unit->hospital_unit_id, ['controller' => 'HospitalUnits', 'action' => 'view', $formRecord->hospital_unit->hospital_unit_id]) : '' ?></td>
                <td><?= $formRecord->has('questionnaire') ? $this->Html->link($formRecord->questionnaire->questionnaire_id, ['controller' => 'Questionnaires', 'action' => 'view', $formRecord->questionnaire->questionnaire_id]) : '' ?></td>
                <td><?= $formRecord->has('crfform') ? $this->Html->link($formRecord->crfform->crfform_id, ['controller' => 'Crfforms', 'action' => 'view', $formRecord->crfform->crfform_id]) : '' ?></td>
                <td><?= h($formRecord->dtRegistroForm) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $formRecord->form_record_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $formRecord->form_record_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $formRecord->form_record_id], ['confirm' => __('Are you sure you want to delete # {0}?', $formRecord->form_record_id)]) ?>
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
