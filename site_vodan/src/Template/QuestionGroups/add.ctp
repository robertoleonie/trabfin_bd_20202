<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroup $questionGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Question Groups'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="questionGroups form large-9 medium-8 columns content">
    <?= $this->Form->create($questionGroup) ?>
    <fieldset>
        <legend><?= __('Add Question Group') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
