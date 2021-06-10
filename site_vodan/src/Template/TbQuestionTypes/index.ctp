<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionType[]|\Cake\Collection\CollectionInterface $tbQuestionTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestionTypes index large-9 medium-8 columns content">
    <h3><?= __('Question Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('question_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbQuestionTypes as $tbQuestionType): ?>
            <tr>
                <td><?= $this->Number->format($tbQuestionType->question_type_id) ?></td>
                <td><?= h($tbQuestionType->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Clone'), ['action' => 'add', '?' => array('description' => $tbQuestionType->description)]) ?>
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
