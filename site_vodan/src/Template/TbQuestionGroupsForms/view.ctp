<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroupsForm $tbQuestionGroupsForm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Question Groups Form'), ['action' => 'edit', $tbQuestionGroupsForm->crfform_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Question Groups Form'), ['action' => 'delete', $tbQuestionGroupsForm->crfform_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestionGroupsForm->crfform_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Question Groups Forms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Question Groups Form'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbQuestionGroupsForms view large-9 medium-8 columns content">
    <h3><?= h($tbQuestionGroupsForm->crfform_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Crfform Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsForm->crfform_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Question Id') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsForm->question_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QuestionOrder') ?></th>
            <td><?= $this->Number->format($tbQuestionGroupsForm->questionOrder) ?></td>
        </tr>
    </table>
</div>
