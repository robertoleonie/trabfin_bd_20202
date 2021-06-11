<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Crfform $crfform
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Crfform'), ['action' => 'edit', $crfform->crfform_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Crfform'), ['action' => 'delete', $crfform->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $crfform->crfform_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Crfforms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crfform'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="crfforms view large-9 medium-8 columns content">
    <h3><?= h($crfform->crfform_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Questionnaire') ?></th>
            <td><?= $crfform->has('questionnaire') ? $this->Html->link($crfform->questionnaire->questionnaire_id, ['controller' => 'Questionnaires', 'action' => 'view', $crfform->questionnaire->questionnaire_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($crfform->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crfform Id') ?></th>
            <td><?= $this->Number->format($crfform->crfform_id) ?></td>
        </tr>
    </table>
</div>
