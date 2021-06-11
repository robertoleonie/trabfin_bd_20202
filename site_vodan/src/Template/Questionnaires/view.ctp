<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Questionnaire $questionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Questionnaire'), ['action' => 'edit', $questionnaire->questionnaire_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Questionnaire'), ['action' => 'delete', $questionnaire->questionnaire_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionnaire->questionnaire_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionnaires view large-9 medium-8 columns content">
    <h3><?= h($questionnaire->questionnaire_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($questionnaire->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire Id') ?></th>
            <td><?= $this->Number->format($questionnaire->questionnaire_id) ?></td>
        </tr>
    </table>
</div>
