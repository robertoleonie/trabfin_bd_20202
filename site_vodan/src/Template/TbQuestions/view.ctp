<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestion $tbQuestion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Question'), ['action' => 'edit', $tbQuestion->question_idb]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Question'), ['action' => 'delete', $tbQuestion->question_idb], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestion->question_idb)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb Question Types'), ['controller' => 'TbQuestionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question Type'), ['controller' => 'TbQuestionTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['controller' => 'TbListOfValues', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['controller' => 'TbListOfValues', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb Question Groups'), ['controller' => 'TbQuestionGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question Group'), ['controller' => 'TbQuestionGroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbQuestions view large-9 medium-8 columns content">
    <h3><?= h($tbQuestion->question_idb) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbQuestion->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb Question Type') ?></th>
            <td><?= $tbQuestion->has('tb_question_type') ? $this->Html->link($tbQuestion->tb_question_type->question_type_id, ['controller' => 'TbQuestionTypes', 'action' => 'view', $tbQuestion->tb_question_type->question_type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb List Of Value') ?></th>
            <td><?= $tbQuestion->has('tb_list_of_value') ? $this->Html->link($tbQuestion->tb_list_of_value->list_of_value_id, ['controller' => 'TbListOfValues', 'action' => 'view', $tbQuestion->tb_list_of_value->list_of_value_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tb Question Group') ?></th>
            <td><?= $tbQuestion->has('tb_question_group') ? $this->Html->link($tbQuestion->tb_question_group->question_group_id, ['controller' => 'TbQuestionGroups', 'action' => 'view', $tbQuestion->tb_question_group->question_group_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Idb') ?></th>
            <td><?= $this->Number->format($tbQuestion->question_idb) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubordinateTo') ?></th>
            <td><?= $this->Number->format($tbQuestion->subordinateTo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsAbout') ?></th>
            <td><?= $this->Number->format($tbQuestion->isAbout) ?></td>
        </tr>
    </table>
</div>
