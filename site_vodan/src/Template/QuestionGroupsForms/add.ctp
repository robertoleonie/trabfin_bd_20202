<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\QuestionGroupsForm $questionGroupsForm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Question Groups Forms'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionGroupsForms form large-9 medium-8 columns content">
    <?= $this->Form->create($questionGroupsForm) ?>
    <fieldset>
        <legend><?= __('Add Question Groups Form') ?></legend>
        <?php
            echo $this->Form->control('questionOrder');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
