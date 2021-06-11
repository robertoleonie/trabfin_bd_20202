<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionType $questionType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Question Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="questionTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($questionType) ?>
    <fieldset>
        <legend><?= __('Add Question Type') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
