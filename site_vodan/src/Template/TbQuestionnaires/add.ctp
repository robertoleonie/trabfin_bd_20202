<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionnaire $tbQuestionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb Questionnaires'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbQuestionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestionnaire) ?>
    <fieldset>
        <legend><?= __('Add Tb Questionnaire') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
