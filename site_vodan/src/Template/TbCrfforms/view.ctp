<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbCrfform $tbCrfform
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Crfform'), ['action' => 'edit', $tbCrfform->crfform_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Crfform'), ['action' => 'delete', $tbCrfform->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbCrfform->crfform_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Crfforms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbCrfforms view large-9 medium-8 columns content">
    <h3><?= h($tbCrfform->crfform_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbCrfform->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crfform Id') ?></th>
            <td><?= $this->Number->format($tbCrfform->crfform_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire Id') ?></th>
            <td><?= $this->Number->format($tbCrfform->questionnaire_id) ?></td>
        </tr>
    </table>
</div>
