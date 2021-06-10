<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroupsFormsRecord[]|\Cake\Collection\CollectionInterface $tbQuestionGroupsFormsRecords
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Question Groups Forms Record'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Crfforms'), ['controller' => 'TbCrfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['controller' => 'TbCrfforms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['controller' => 'TbListOfValues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['controller' => 'TbListOfValues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestionGroupsFormsRecords index large-9 medium-8 columns content">
    <h3><?= __('Tb Question Groups Forms Records') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('questionGroupFormRecordID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('form_record_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_idb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('list_of_value_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('answer') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbQuestionGroupsFormsRecords as $tbQuestionGroupsFormsRecord): ?>
            <tr>
                <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->questionGroupFormRecordID) ?></td>
                <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->form_record_id) ?></td>
                <td><?= $tbQuestionGroupsFormsRecord->has('tb_crfform') ? $this->Html->link($tbQuestionGroupsFormsRecord->tb_crfform->crfform_id, ['controller' => 'TbCrfforms', 'action' => 'view', $tbQuestionGroupsFormsRecord->tb_crfform->crfform_id]) : '' ?></td>
                <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->question_idb) ?></td>
                <td><?= $tbQuestionGroupsFormsRecord->has('tb_list_of_value') ? $this->Html->link($tbQuestionGroupsFormsRecord->tb_list_of_value->list_of_value_id, ['controller' => 'TbListOfValues', 'action' => 'view', $tbQuestionGroupsFormsRecord->tb_list_of_value->list_of_value_id]) : '' ?></td>
                <td><?= h($tbQuestionGroupsFormsRecord->answer) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID)]) ?>
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
