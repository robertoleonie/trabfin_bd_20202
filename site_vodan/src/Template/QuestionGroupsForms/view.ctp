<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroupsForm $questionGroupsForm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question Groups Form'), ['action' => 'edit', $questionGroupsForm->crfform_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question Groups Form'), ['action' => 'delete', $questionGroupsForm->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroupsForm->crfform_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Question Groups Forms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Groups Form'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionGroupsForms view large-9 medium-8 columns content">
    <h3><?= h($questionGroupsForm->crfform_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Crfform') ?></th>
            <td><?= $questionGroupsForm->has('crfform') ? $this->Html->link($questionGroupsForm->crfform->crfform_id, ['controller' => 'Crfforms', 'action' => 'view', $questionGroupsForm->crfform->crfform_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionGroupsForm->has('question') ? $this->Html->link($questionGroupsForm->question->question_id, ['controller' => 'Questions', 'action' => 'view', $questionGroupsForm->question->question_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QuestionOrder') ?></th>
            <td><?= $this->Number->format($questionGroupsForm->questionOrder) ?></td>
        </tr>
    </table>
</div>
