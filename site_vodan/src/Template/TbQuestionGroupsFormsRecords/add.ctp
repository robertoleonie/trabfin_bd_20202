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
    </ul>
</nav>
<div class="tbQuestionGroupsFormsRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestionGroupsFormsRecord) ?>
    <fieldset>
        <legend><?= __('Add Tb Question Groups Forms Record') ?></legend>
        <?php
            echo $this->Form->control('form_record_id');
            echo $this->Form->control('crfform_id');
            echo $this->Form->control('question_id');
            echo $this->Form->control('list_of_value_id');
            echo $this->Form->control('answer');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
