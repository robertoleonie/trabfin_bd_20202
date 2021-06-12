<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Questionnaire[]|\Cake\Collection\CollectionInterface $questionnaires
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionnaires index large-9 medium-8 columns content">
    <h3><?= __('Questionnaires') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('questionnaire_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionnaires as $questionnaire): ?>
            <tr>
                <td><?= $this->Number->format($questionnaire->questionnaire_id) ?></td>
                <td><?= h($questionnaire->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consult Modules - '), ['action' => 'view', $questionnaire->questionnaire_id]) ?>
                    <?= $this->Html->link(__('Edit Modules - '), ['action' => 'edit', $questionnaire->questionnaire_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionnaire->questionnaire_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionnaire->questionnaire_id)]) ?>
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
