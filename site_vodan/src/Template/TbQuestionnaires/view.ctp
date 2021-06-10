<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionnaire $tbQuestionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Questionnaire'), ['action' => 'edit', $tbQuestionnaire->questionnaire_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Questionnaire'), ['action' => 'delete', $tbQuestionnaire->questionnaire_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionnaire->questionnaire_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Questionnaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Questionnaire'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbQuestionnaires view large-9 medium-8 columns content">
    <h3><?= h($tbQuestionnaire->questionnaire_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbQuestionnaire->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire Id') ?></th>
            <td><?= $this->Number->format($tbQuestionnaire->questionnaire_id) ?></td>
        </tr>
    </table>
</div>
