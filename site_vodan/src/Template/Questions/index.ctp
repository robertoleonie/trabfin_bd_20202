<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question[]|\Cake\Collection\CollectionInterface $questions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Question Types'), ['controller' => 'QuestionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question Type'), ['controller' => 'QuestionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List List Types'), ['controller' => 'ListTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New List Type'), ['controller' => 'ListTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Question Groups'), ['controller' => 'QuestionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question Group'), ['controller' => 'QuestionGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions index large-9 medium-8 columns content">
    <h3><?= __('Questions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
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
            <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= $this->Number->format($question->question_id) ?></td>
                <td><?= h($question->description) ?></td>
                <td><?= $question->has('question_type') ? $this->Html->link($question->question_type->question_type_id, ['controller' => 'QuestionTypes', 'action' => 'view', $question->question_type->question_type_id]) : '' ?></td>
                <td><?= $question->has('list_type') ? $this->Html->link($question->list_type->list_type_id, ['controller' => 'ListTypes', 'action' => 'view', $question->list_type->list_type_id]) : '' ?></td>
                <td><?= $question->has('question_group') ? $this->Html->link($question->question_group->question_group_id, ['controller' => 'QuestionGroups', 'action' => 'view', $question->question_group->question_group_id]) : '' ?></td>
                <td><?= $this->Number->format($question->subordinateTo) ?></td>
                <td><?= $this->Number->format($question->isAbout) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $question->question_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $question->question_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $question->question_id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->question_id)]) ?>
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
