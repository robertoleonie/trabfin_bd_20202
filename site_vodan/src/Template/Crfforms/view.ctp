<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Crfform $crfform
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Crfform'), ['action' => 'edit', $crfform->crfform_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Crfform'), ['action' => 'delete', $crfform->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $crfform->crfform_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Crfforms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crfform'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="crfforms view large-9 medium-8 columns content">
    <h3><?= h($crfform->crfform_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Questionnaire') ?></th>
            <td><?= $crfform->has('questionnaire') ? $this->Html->link($crfform->questionnaire->description, ['controller' => 'Questionnaires', 'action' => 'view', $crfform->questionnaire->questionnaire_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($crfform->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crfform Id') ?></th>
            <td><?= $this->Number->format($crfform->crfform_id) ?></td>
        </tr>
    </table>
    
    <div class="listOfValues index columns content">
        <div class="row">
            <div class="columns large-8">
                <h5><?= __("List of questions of:\n".$crfform->description) ?></h5>
            </div>
            <div class="columns large-3">
                <?= $this->Html->link(__('New question'), 
                ['controller' => 'Crfforms', 'action' => 'add', '?' => array('crfform' => $crfform->crfform_id) ],
                ['class' => 'button right']) ?>
                
            </div>
        </div>
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
    
</div>
