<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListType[]|\Cake\Collection\CollectionInterface $listTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New List Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="listTypes index large-9 medium-8 columns content">
    <h3><?= __('List Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('list_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listTypes as $listType): ?>
            <tr>
                <td><?= $this->Number->format($listType->list_type_id) ?></td>
                <td><?= h($listType->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Open'), ['action' => 'view', $listType->list_type_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $listType->list_type_id]) ?>
                    
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
