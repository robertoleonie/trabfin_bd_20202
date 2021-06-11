<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListOfValue[]|\Cake\Collection\CollectionInterface $listOfValues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New List Of Value'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List List Types'), ['controller' => 'ListTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New List Type'), ['controller' => 'ListTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="listOfValues index large-9 medium-8 columns content">
    <h3><?= __('List Of Values') ?></h3>
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
            <?php foreach ($listOfValues as $listOfValue): ?>
            <tr>
                <td><?= $this->Number->format($listOfValue->list_of_value_id) ?></td>
                <td><?= $listOfValue->has('list_type') ? $this->Html->link($listOfValue->list_type->description, ['controller' => 'ListTypes', 'action' => 'view', $listOfValue->list_type->list_type_id]) : '' ?></td>
                <td><?= h($listOfValue->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $listOfValue->list_of_value_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $listOfValue->list_of_value_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $listOfValue->list_of_value_id], ['confirm' => __('Are you sure you want to delete # {0}?', $listOfValue->list_of_value_id)]) ?>
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
