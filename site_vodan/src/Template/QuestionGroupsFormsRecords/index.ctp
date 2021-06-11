<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroupsFormsRecord[]|\Cake\Collection\CollectionInterface $questionGroupsFormsRecords
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question Groups Forms Record'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Form Records'), ['controller' => 'FormRecords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form Record'), ['controller' => 'FormRecords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List List Of Values'), ['controller' => 'ListOfValues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New List Of Value'), ['controller' => 'ListOfValues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionGroupsFormsRecords index large-9 medium-8 columns content">
    <h3><?= __('Question Groups Forms Records') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('questionGroupFormRecordID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_record_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('list_of_value_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answer') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionGroupsFormsRecords as $questionGroupsFormsRecord): ?>
            <tr>
                <td><?= $this->Number->format($questionGroupsFormsRecord->questionGroupFormRecordID) ?></td>
                <td><?= $questionGroupsFormsRecord->has('form_record') ? $this->Html->link($questionGroupsFormsRecord->form_record->form_record_id, ['controller' => 'FormRecords', 'action' => 'view', $questionGroupsFormsRecord->form_record->form_record_id]) : '' ?></td>
                <td><?= $questionGroupsFormsRecord->has('crfform') ? $this->Html->link($questionGroupsFormsRecord->crfform->crfform_id, ['controller' => 'Crfforms', 'action' => 'view', $questionGroupsFormsRecord->crfform->crfform_id]) : '' ?></td>
                <td><?= $questionGroupsFormsRecord->has('question') ? $this->Html->link($questionGroupsFormsRecord->question->question_id, ['controller' => 'Questions', 'action' => 'view', $questionGroupsFormsRecord->question->question_id]) : '' ?></td>
                <td><?= $questionGroupsFormsRecord->has('list_of_value') ? $this->Html->link($questionGroupsFormsRecord->list_of_value->list_of_value_id, ['controller' => 'ListOfValues', 'action' => 'view', $questionGroupsFormsRecord->list_of_value->list_of_value_id]) : '' ?></td>
                <td><?= h($questionGroupsFormsRecord->answer) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionGroupsFormsRecord->questionGroupFormRecordID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionGroupsFormsRecord->questionGroupFormRecordID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionGroupsFormsRecord->questionGroupFormRecordID], ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroupsFormsRecord->questionGroupFormRecordID)]) ?>
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
