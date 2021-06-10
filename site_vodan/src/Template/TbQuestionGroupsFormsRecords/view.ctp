<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroupsFormsRecord $tbQuestionGroupsFormsRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Question Groups Forms Record'), ['action' => 'edit', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Question Groups Forms Record'), ['action' => 'delete', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionGroupsFormsRecord->questionGroupFormRecordID)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Question Groups Forms Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question Groups Forms Record'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb Crfforms'), ['controller' => 'TbCrfforms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['controller' => 'TbCrfforms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['controller' => 'TbListOfValues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['controller' => 'TbListOfValues', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbQuestionGroupsFormsRecords view large-9 medium-8 columns content">
    <h3><?= h($tbQuestionGroupsFormsRecord->questionGroupFormRecordID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tb Crfform') ?></th>
            <td><?= $tbQuestionGroupsFormsRecord->has('tb_crfform') ? $this->Html->link($tbQuestionGroupsFormsRecord->tb_crfform->crfform_id, ['controller' => 'TbCrfforms', 'action' => 'view', $tbQuestionGroupsFormsRecord->tb_crfform->crfform_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb List Of Value') ?></th>
            <td><?= $tbQuestionGroupsFormsRecord->has('tb_list_of_value') ? $this->Html->link($tbQuestionGroupsFormsRecord->tb_list_of_value->list_of_value_id, ['controller' => 'TbListOfValues', 'action' => 'view', $tbQuestionGroupsFormsRecord->tb_list_of_value->list_of_value_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer') ?></th>
            <td><?= h($tbQuestionGroupsFormsRecord->answer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QuestionGroupFormRecordID') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->questionGroupFormRecordID) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Record Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->form_record_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Idb') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->question_idb) ?></td>
        </tr>
    </table>
</div>
