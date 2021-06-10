<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbParticipant[]|\Cake\Collection\CollectionInterface $tbParticipants
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Participant'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbParticipants index large-9 medium-8 columns content">
    <h3><?= __('Tb Participants') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('participant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('medicalRecord') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbParticipants as $tbParticipant): ?>
            <tr>
                <td><?= $this->Number->format($tbParticipant->participant_id) ?></td>
                <td><?= h($tbParticipant->medicalRecord) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbParticipant->participant_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbParticipant->participant_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbParticipant->participant_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbParticipant->participant_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
