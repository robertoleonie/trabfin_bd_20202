<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroupsFormsRecord $tbQuestionGroupsFormsRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb Question Groups Forms Records'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tb Crfforms'), ['controller' => 'TbCrfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['controller' => 'TbCrfforms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['controller' => 'TbListOfValues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['controller' => 'TbListOfValues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestionGroupsFormsRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestionGroupsFormsRecord) ?>
    <fieldset>
        <legend><?= __('Add Tb Question Groups Forms Record') ?></legend>
        <?php
            echo $this->Form->control('form_record_id');
            echo $this->Form->control('crfform_id', ['options' => $tbCrfforms]);
            echo $this->Form->control('question_idb');
            echo $this->Form->control('list_of_value_id', ['options' => $tbListOfValues, 'empty' => true]);
            echo $this->Form->control('answer');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
