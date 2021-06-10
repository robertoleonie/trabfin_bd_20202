<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestion $tbQuestion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb Questions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestion) ?>
    <fieldset>
        <legend><?= __('Add Tb Question') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('question_type_id');
            echo $this->Form->control('list_type_id');
            echo $this->Form->control('question_group_id');
            echo $this->Form->control('subordinateTo');
            echo $this->Form->control('isAbout');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
