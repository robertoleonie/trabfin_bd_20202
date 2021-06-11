<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroupsForm[]|\Cake\Collection\CollectionInterface $questionGroupsForms
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question Groups Form'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionGroupsForms index large-9 medium-8 columns content">
    <h3><?= __('Question Groups Forms') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('questionOrder') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionGroupsForms as $questionGroupsForm): ?>
            <tr>
                <td><?= $questionGroupsForm->has('crfform') ? $this->Html->link($questionGroupsForm->crfform->crfform_id, ['controller' => 'Crfforms', 'action' => 'view', $questionGroupsForm->crfform->crfform_id]) : '' ?></td>
                <td><?= $questionGroupsForm->has('question') ? $this->Html->link($questionGroupsForm->question->question_id, ['controller' => 'Questions', 'action' => 'view', $questionGroupsForm->question->question_id]) : '' ?></td>
                <td><?= $this->Number->format($questionGroupsForm->questionOrder) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionGroupsForm->crfform_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionGroupsForm->crfform_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionGroupsForm->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroupsForm->crfform_id)]) ?>
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
