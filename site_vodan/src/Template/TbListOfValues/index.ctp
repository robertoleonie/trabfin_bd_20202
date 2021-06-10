<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbListOfValue[]|\Cake\Collection\CollectionInterface $tbListOfValues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbListOfValues index large-9 medium-8 columns content">
    <h3><?= __('Tb List Of Values') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('list_of_value_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('list_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbListOfValues as $tbListOfValue): ?>
            <tr>
                <td><?= $this->Number->format($tbListOfValue->list_of_value_id) ?></td>
                <td><?= $this->Number->format($tbListOfValue->list_type_id) ?></td>
                <td><?= h($tbListOfValue->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbListOfValue->list_of_value_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbListOfValue->list_of_value_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbListOfValue->list_of_value_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbListOfValue->list_of_value_id)]) ?>
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
