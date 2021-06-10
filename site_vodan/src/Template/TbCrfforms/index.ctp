<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbCrfform[]|\Cake\Collection\CollectionInterface $tbCrfforms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbCrfforms index large-9 medium-8 columns content">
    <h3><?= __('Tb Crfforms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('questionnaire_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbCrfforms as $tbCrfform): ?>
            <tr>
                <td><?= $this->Number->format($tbCrfform->crfform_id) ?></td>
                <td><?= $this->Number->format($tbCrfform->questionnaire_id) ?></td>
                <td><?= h($tbCrfform->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbCrfform->crfform_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbCrfform->crfform_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbCrfform->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbCrfform->crfform_id)]) ?>
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
