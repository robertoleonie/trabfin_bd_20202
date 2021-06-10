<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroup $tbQuestionGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Question Group'), ['action' => 'edit', $tbQuestionGroup->question_group_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Question Group'), ['action' => 'delete', $tbQuestionGroup->question_group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionGroup->question_group_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Question Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question Group'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbQuestionGroups view large-9 medium-8 columns content">
    <h3><?= h($tbQuestionGroup->question_group_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbQuestionGroup->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($tbQuestionGroup->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Group Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroup->question_group_id) ?></td>
        </tr>
    </table>
</div>
