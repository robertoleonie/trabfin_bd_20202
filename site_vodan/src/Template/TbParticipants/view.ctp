<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbParticipant $tbParticipant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Participant'), ['action' => 'edit', $tbParticipant->participant_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Participant'), ['action' => 'delete', $tbParticipant->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbParticipant->participant_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Participants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Participant'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbParticipants view large-9 medium-8 columns content">
    <h3><?= h($tbParticipant->participant_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('MedicalRecord') ?></th>
            <td><?= h($tbParticipant->medicalRecord) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Participant Id') ?></th>
            <td><?= $this->Number->format($tbParticipant->participant_id) ?></td>
        </tr>
    </table>
</div>
