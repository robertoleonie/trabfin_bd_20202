<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroup $tbQuestionGroup
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb Question Groups'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbQuestionGroups form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestionGroup) ?>
    <fieldset>
        <legend><?= __('Add Tb Question Group') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
