<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Participant $participant
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Participant'), ['action' => 'edit', $participant->participant_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Participant'), ['action' => 'delete', $participant->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $participant->participant_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Participants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participant'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="participants view large-9 medium-8 columns content">
    <h3><?= h($participant->participant_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('MedicalRecord') ?></th>
            <td><?= h($participant->medicalRecord) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Participant Id') ?></th>
            <td><?= $this->Number->format($participant->participant_id) ?></td>
        </tr>
    </table>
</div>
