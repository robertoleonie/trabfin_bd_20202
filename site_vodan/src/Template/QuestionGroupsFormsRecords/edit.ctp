<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroupsFormsRecord $questionGroupsFormsRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $questionGroupsFormsRecord->questionGroupFormRecordID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $questionGroupsFormsRecord->questionGroupFormRecordID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Question Groups Forms Records'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Form Records'), ['controller' => 'FormRecords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Form Record'), ['controller' => 'FormRecords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List List Of Values'), ['controller' => 'ListOfValues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New List Of Value'), ['controller' => 'ListOfValues', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionGroupsFormsRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($questionGroupsFormsRecord) ?>
    <fieldset>
        <legend><?= __('Edit Question Groups Forms Record') ?></legend>
        <?php
            echo $this->Form->control('form_record_id', ['options' => $formRecords]);
            echo $this->Form->control('crfform_id', ['options' => $crfforms]);
            echo $this->Form->control('question_id', ['options' => $questions]);
            echo $this->Form->control('list_of_value_id', ['options' => $listOfValues, 'empty' => true]);
            echo $this->Form->control('answer');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
