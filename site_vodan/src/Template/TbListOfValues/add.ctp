<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbListOfValue $tbListOfValue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tb List Types'), ['controller' => 'TbListTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb List Type'), ['controller' => 'TbListTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbListOfValues form large-9 medium-8 columns content">
    <?= $this->Form->create($tbListOfValue) ?>
    <fieldset>
        <legend><?= __('Add Tb List Of Value') ?></legend>
        <?php
            echo $this->Form->control('list_type_id', ['options' => $tbListTypes]);
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
