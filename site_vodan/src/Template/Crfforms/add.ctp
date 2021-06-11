<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Crfform $crfform
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="crfforms form large-9 medium-8 columns content">
    <?= $this->Form->create($crfform) ?>
    <fieldset>
        <legend><?= __('Add Crfform') ?></legend>
        <?php
            echo $this->Form->control('questionnaire_id', ['options' => $questionnaires]);
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
