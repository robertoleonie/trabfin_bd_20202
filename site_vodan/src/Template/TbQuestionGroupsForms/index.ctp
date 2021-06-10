<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroupsForm[]|\Cake\Collection\CollectionInterface $tbQuestionGroupsForms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Question Groups Form'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Crfforms'), ['controller' => 'TbCrfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['controller' => 'TbCrfforms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestionGroupsForms index large-9 medium-8 columns content">
    <h3><?= __('Tb Question Groups Forms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_idb') ?></th>
                <th scope="col"><?= $this->Paginator->sort('questionOrder') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbQuestionGroupsForms as $tbQuestionGroupsForm): ?>
            <tr>
                <td><?= $tbQuestionGroupsForm->has('tb_crfform') ? $this->Html->link($tbQuestionGroupsForm->tb_crfform->crfform_id, ['controller' => 'TbCrfforms', 'action' => 'view', $tbQuestionGroupsForm->tb_crfform->crfform_id]) : '' ?></td>
                <td><?= $this->Number->format($tbQuestionGroupsForm->question_idb) ?></td>
                <td><?= $this->Number->format($tbQuestionGroupsForm->questionOrder) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbQuestionGroupsForm->crfform_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbQuestionGroupsForm->crfform_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbQuestionGroupsForm->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionGroupsForm->crfform_id)]) ?>
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
