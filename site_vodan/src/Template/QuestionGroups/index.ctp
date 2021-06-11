<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroup[]|\Cake\Collection\CollectionInterface $questionGroups
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question Group'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionGroups index large-9 medium-8 columns content">
    <h3><?= __('Question Groups') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('question_group_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionGroups as $questionGroup): ?>
            <tr>
                <td><?= $this->Number->format($questionGroup->question_group_id) ?></td>
                <td><?= h($questionGroup->description) ?></td>
                <td><?= h($questionGroup->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionGroup->question_group_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionGroup->question_group_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionGroup->question_group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroup->question_group_id)]) ?>
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
