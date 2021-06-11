<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroupsFormsRecord $questionGroupsFormsRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question Groups Forms Record'), ['action' => 'edit', $questionGroupsFormsRecord->questionGroupFormRecordID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question Groups Forms Record'), ['action' => 'delete', $questionGroupsFormsRecord->questionGroupFormRecordID], ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroupsFormsRecord->questionGroupFormRecordID)]) ?> </li>
        <li><?= $this->Html->link(__('List Question Groups Forms Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Groups Forms Record'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Form Records'), ['controller' => 'FormRecords', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form Record'), ['controller' => 'FormRecords', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List List Of Values'), ['controller' => 'ListOfValues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New List Of Value'), ['controller' => 'ListOfValues', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionGroupsFormsRecords view large-9 medium-8 columns content">
    <h3><?= h($questionGroupsFormsRecord->questionGroupFormRecordID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Form Record') ?></th>
            <td><?= $questionGroupsFormsRecord->has('form_record') ? $this->Html->link($questionGroupsFormsRecord->form_record->form_record_id, ['controller' => 'FormRecords', 'action' => 'view', $questionGroupsFormsRecord->form_record->form_record_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crfform') ?></th>
            <td><?= $questionGroupsFormsRecord->has('crfform') ? $this->Html->link($questionGroupsFormsRecord->crfform->crfform_id, ['controller' => 'Crfforms', 'action' => 'view', $questionGroupsFormsRecord->crfform->crfform_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionGroupsFormsRecord->has('question') ? $this->Html->link($questionGroupsFormsRecord->question->question_id, ['controller' => 'Questions', 'action' => 'view', $questionGroupsFormsRecord->question->question_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Of Value') ?></th>
            <td><?= $questionGroupsFormsRecord->has('list_of_value') ? $this->Html->link($questionGroupsFormsRecord->list_of_value->list_of_value_id, ['controller' => 'ListOfValues', 'action' => 'view', $questionGroupsFormsRecord->list_of_value->list_of_value_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Answer') ?></th>
            <td><?= h($questionGroupsFormsRecord->answer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QuestionGroupFormRecordID') ?></th>
            <td><?= $this->Number->format($questionGroupsFormsRecord->questionGroupFormRecordID) ?></td>
        </tr>
    </table>
</div>
