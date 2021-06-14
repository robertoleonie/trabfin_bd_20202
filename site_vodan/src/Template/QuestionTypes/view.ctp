<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionType $questionType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question Type'), ['action' => 'edit', $questionType->question_type_id]) ?> </li>
        <li><?= $this->Html->link(__('List Question Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionTypes view large-9 medium-8 columns content">
    <h3><?= h($questionType->description) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($questionType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Type Id') ?></th>
            <td><?= $this->Number->format($questionType->question_type_id) ?></td>
        </tr>
    </table>
</div>