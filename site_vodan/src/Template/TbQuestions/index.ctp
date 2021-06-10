<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestion[]|\Cake\Collection\CollectionInterface $tbQuestions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Question Types'), ['controller' => 'TbQuestionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Question Type'), ['controller' => 'TbQuestionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['controller' => 'TbListOfValues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['controller' => 'TbListOfValues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Question Groups'), ['controller' => 'TbQuestionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Question Group'), ['controller' => 'TbQuestionGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestions index large-9 medium-8 columns content">
    <h3><?= __('Tb Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('question_idb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('list_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_group_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subordinateTo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('isAbout') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbQuestions as $tbQuestion): ?>
            <tr>
                <td><?= $this->Number->format($tbQuestion->question_idb) ?></td>
                <td><?= h($tbQuestion->description) ?></td>
                <td><?= $tbQuestion->has('tb_question_type') ? $this->Html->link($tbQuestion->tb_question_type->question_type_id, ['controller' => 'TbQuestionTypes', 'action' => 'view', $tbQuestion->tb_question_type->question_type_id]) : '' ?></td>
                <td><?= $tbQuestion->has('tb_list_of_value') ? $this->Html->link($tbQuestion->tb_list_of_value->list_of_value_id, ['controller' => 'TbListOfValues', 'action' => 'view', $tbQuestion->tb_list_of_value->list_of_value_id]) : '' ?></td>
                <td><?= $tbQuestion->has('tb_question_group') ? $this->Html->link($tbQuestion->tb_question_group->question_group_id, ['controller' => 'TbQuestionGroups', 'action' => 'view', $tbQuestion->tb_question_group->question_group_id]) : '' ?></td>
                <td><?= $this->Number->format($tbQuestion->subordinateTo) ?></td>
                <td><?= $this->Number->format($tbQuestion->isAbout) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbQuestion->question_idb]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbQuestion->question_idb]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbQuestion->question_idb], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestion->question_idb)]) ?>
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
