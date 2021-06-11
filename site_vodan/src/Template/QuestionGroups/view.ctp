<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroup $questionGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question Group'), ['action' => 'edit', $questionGroup->question_group_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question Group'), ['action' => 'delete', $questionGroup->question_group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroup->question_group_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Question Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Group'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionGroups view large-9 medium-8 columns content">
    <h3><?= h($questionGroup->question_group_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($questionGroup->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($questionGroup->comment) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Group Id') ?></th>
            <td><?= $this->Number->format($questionGroup->question_group_id) ?></td>
        </tr>
    </table>
</div>
