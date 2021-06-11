<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->question_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->question_id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->question_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question Types'), ['controller' => 'QuestionTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Type'), ['controller' => 'QuestionTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List List Types'), ['controller' => 'ListTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New List Type'), ['controller' => 'ListTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question Groups'), ['controller' => 'QuestionGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Group'), ['controller' => 'QuestionGroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->question_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($question->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Type') ?></th>
            <td><?= $question->has('question_type') ? $this->Html->link($question->question_type->question_type_id, ['controller' => 'QuestionTypes', 'action' => 'view', $question->question_type->question_type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Type') ?></th>
            <td><?= $question->has('list_type') ? $this->Html->link($question->list_type->list_type_id, ['controller' => 'ListTypes', 'action' => 'view', $question->list_type->list_type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Group') ?></th>
            <td><?= $question->has('question_group') ? $this->Html->link($question->question_group->question_group_id, ['controller' => 'QuestionGroups', 'action' => 'view', $question->question_group->question_group_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Id') ?></th>
            <td><?= $this->Number->format($question->question_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SubordinateTo') ?></th>
            <td><?= $this->Number->format($question->subordinateTo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IsAbout') ?></th>
            <td><?= $this->Number->format($question->isAbout) ?></td>
        </tr>
    </table>
</div>
