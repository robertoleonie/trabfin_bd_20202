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
    </ul>
</nav>
<div class="tbQuestionGroupsFormsRecords view large-9 medium-8 columns content">
    <h3><?= h($tbQuestionGroupsFormsRecord->questionGroupFormRecordID) ?></h3>
    <table class="vertical-table">
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
            <th scope="row"><?= __('Crfform Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->crfform_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->question_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Of Value Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsFormsRecord->list_of_value_id) ?></td>
        </tr>
    </table>
</div>
