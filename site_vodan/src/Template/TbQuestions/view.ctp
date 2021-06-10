<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestion $tbQuestion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Question'), ['action' => 'edit', $tbQuestion->question_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Question'), ['action' => 'delete', $tbQuestion->question_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestion->question_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbQuestions view large-9 medium-8 columns content">
    <h3><?= h($tbQuestion->question_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbQuestion->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Id') ?></th>
            <td><?= $this->Number->format($tbQuestion->question_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Type Id') ?></th>
            <td><?= $this->Number->format($tbQuestion->question_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Type Id') ?></th>
            <td><?= $this->Number->format($tbQuestion->list_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Group Id') ?></th>
            <td><?= $this->Number->format($tbQuestion->question_group_id) ?></td>
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
