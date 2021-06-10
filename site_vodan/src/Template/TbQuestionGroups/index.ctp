<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroup[]|\Cake\Collection\CollectionInterface $tbQuestionGroups
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Question Group'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestionGroups index large-9 medium-8 columns content">
    <h3><?= __('Tb Question Groups') ?></h3>
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
            <?php foreach ($tbQuestionGroups as $tbQuestionGroup): ?>
            <tr>
                <td><?= $this->Number->format($tbQuestionGroup->question_group_id) ?></td>
                <td><?= h($tbQuestionGroup->description) ?></td>
                <td><?= h($tbQuestionGroup->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbQuestionGroup->question_group_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbQuestionGroup->question_group_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbQuestionGroup->question_group_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionGroup->question_group_id)]) ?>
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
