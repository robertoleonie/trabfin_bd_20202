<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionGroupsForm $tbQuestionGroupsForm
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb Question Groups Forms'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tb Crfforms'), ['controller' => 'TbCrfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Crfform'), ['controller' => 'TbCrfforms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestionGroupsForms form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestionGroupsForm) ?>
    <fieldset>
        <legend><?= __('Add Tb Question Groups Form') ?></legend>
        <?php
            echo $this->Form->control('questionOrder');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
